<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Option;
use App\Models\OptionDetail;

class OptionDetailSeeder extends Seeder
{
    public function run(): void
    {
        // اگر هیچ Option در دیتابیس نیست، خطا بده تا فراموش نکنی قبلش OptionSeeder اجرا بشه
        if (Option::count() === 0) {
            throw new \Exception('هیچ گزینه‌ای (Option) در دیتابیس وجود ندارد. ابتدا OptionSeeder را اجرا کنید.');
        }

        // برای هر Option، چند OptionDetail بساز
        Option::all()->each(function ($option) {
            $details = match ($option->name) {
                'رنگ' => [
                    ['name' => 'قرمز', 'price' => 0],
                    ['name' => 'آبی', 'price' => 0],
                    ['name' => 'مشکی', 'price' => 0],
                ],
                'سایز' => [
                    ['name' => 'S', 'price' => 0],
                    ['name' => 'M', 'price' => 0],
                    ['name' => 'L', 'price' => 0],
                    ['name' => 'XL', 'price' => 10000],
                ],
                'جنس' => [
                    ['name' => 'کتان', 'price' => 20000],
                    ['name' => 'چرم', 'price' => 50000],
                    ['name' => 'پلی‌استر', 'price' => 10000],
                ],
                default => [
                    ['name' => 'گزینه ۱', 'price' => 0],
                    ['name' => 'گزینه ۲', 'price' => 0],
                ],
            };

            foreach ($details as $detail) {
                OptionDetail::create([
                    'option_id' => $option->id,
                    'name' => $detail['name'],
                    'price' => $detail['price'],
                ]);
            }
        });
    }
}
