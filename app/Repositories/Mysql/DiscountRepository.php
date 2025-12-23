<?php

namespace App\Repositories\Mysql;

use App\Interface\DiscountRepositoryInterface;
use App\Models\User;
use App\Models\Discount;
use App\Models\DiscountCode;
use App\Models\DiscountUsage;
use App\Models\Product;
use Carbon\Carbon;
use DomainException;
use Illuminate\Support\Facades\DB;

class DiscountRepository implements DiscountRepositoryInterface
{
    public function paginate(array $filters = [])
    {
        $query = Discount::query();

        if (!empty($filters['scope'])) {
            $query->where('scope', $filters['scope']);
        }

        if (isset($filters['is_active'])) {
            $query->where('is_active', (bool) $filters['is_active']);
        }

        if (!empty($filters['status'])) {
            match ($filters['status']) {
                'active' => $query
                    ->where('starts_at', '<=', now())
                    ->where('ends_at', '>=', now()),
                'expired' => $query
                    ->where('ends_at', '<', now()),
                'upcoming' => $query
                    ->where('starts_at', '>', now()),
                default => null,
            };
        }

        return $query
            ->withCount('codes')
            ->latest()
            ->paginate(20);
    }


    public function store(array $data)
    {
        $this->validateDiscountData($data);

        return Discount::create($data);
    }


    public function find(int $id)
    {
        return Discount::with(['codes'])->findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $discount = Discount::findOrFail($id);

        if ($discount->usages()->exists()) {
            unset($data['type'], $data['value'], $data['scope']);
        }

        $this->validateDiscountData(array_merge(
            $discount->toArray(),
            $data
        ));

        $discount->update($data);

        return $discount;
    }


    public function createCode(int $discountId, array $data)
    {
        $discount = Discount::findOrFail($discountId);

        if (!$discount->is_active) {
            throw new \DomainException('امکان ایجاد کد برای تخفیف غیرفعال وجود ندارد');
        }

        if ($discount->is_personal && empty($data['user_id'])) {
            throw new \DomainException('کد تخفیف شخصی باید کاربر داشته باشد');
        }

        return DiscountCode::create([
            'discount_id' => $discountId,
            'user_id'     => $data['user_id'] ?? null,
            'code'        =>  $data['code'] ?? $this->generateCode(),
        ]);
    }


    public function generateCode()
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

        $code = '';

        for ($i = 0; $i < 6; $i++) {
            $code .= $characters[random_int(0, strlen($characters) - 1)];
        }
        $code = implode('-', str_split($code, 4));

        return $code;
    }



    public function usages(array $filters = [])
    {
        $query = DiscountUsage::with([
            'discount',
            'code',
            'order',
            'user'
        ]);

        if (!empty($filters['discount_id'])) {
            $query->where('discount_id', $filters['discount_id']);
        }

        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (!empty($filters['from'])) {
            $query->whereDate('used_at', '>=', $filters['from']);
        }

        if (!empty($filters['to'])) {
            $query->whereDate('used_at', '<=', $filters['to']);
        }

        return $query->latest()->paginate(20);
    }

    public function delete(Discount $discount)
    {
        DB::transaction(function () use ($discount) {

            $discount->codes()->delete();

            $discount->delete();
        });

        return true;
    }




    public function getActiveForProduct(Product $product, User $user)
    {
        $now = Carbon::now();

        return Discount::where('is_active', true)
            ->where('starts_at', '<=', $now)
            ->where('ends_at', '>=', $now)
            ->where(function ($query) use ($product, $user) {

                $query->where(function ($q) use ($product) {
                    $q->where('discountable_type', Product::class)
                        ->where('discountable_id', $product->id);
                })

                    ->orWhere(function ($q) use ($user) {
                        $q->whereExists(function ($sub) use ($user) {
                            $sub->selectRaw(1)
                                ->from('discount_codes')
                                ->whereColumn('discounts.id', 'discount_codes.discount_id')
                                ->where('user_id', $user->id)
                                ->whereNull('used_at');
                        });
                    });
            })
            ->get();
    }

    public function findValidCode(string $code): DiscountCode
    {
        $discountCode = DiscountCode::with('discount')->where('code', $code)->first();

        if (! $discountCode) {
            throw new DomainException('کد تخفیف نامعتبر است');
        }

        if ($discountCode->isUsed()) {
            throw new DomainException('کد قبلاً استفاده شده');
        }

        return $discountCode;
    }

    private function validateDiscountData(array $data): void
    {
        if ($data['starts_at'] >= $data['ends_at']) {
            throw new \DomainException('زمان شروع باید قبل از زمان پایان باشد');
        }

        if ($data['type'] === 'percent' && $data['value'] > 100) {
            throw new \DomainException('درصد تخفیف نمی‌تواند بیشتر از 100 باشد');
        }

        if ($data['value'] <= 0) {
            throw new \DomainException('مقدار تخفیف باید بزرگتر از صفر باشد');
        }

        if (
            in_array($data['scope'], ['product', 'category']) &&
            empty($data['discountable_id'])
        ) {
            throw new \DomainException('برای این نوع تخفیف باید discountable مشخص شود');
        }
    }



}
