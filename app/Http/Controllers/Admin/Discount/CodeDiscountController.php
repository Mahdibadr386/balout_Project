<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Discount\CodeStoreDiscountRequest;
use App\Http\Resources\Admin\Discount\DiscountCodeResource;
use App\Interface\DiscountRepositoryInterface;
use Illuminate\Http\Request;

class CodeDiscountController extends Controller
{
    public function __invoke(int $discountId, CodeStoreDiscountRequest $request, DiscountRepositoryInterface $DiscountRepository)
    {
        auth()->user()->hasPermissionTo('discount.codes') ?: abort(403);

        $data =  $DiscountRepository->createCode($discountId, $request->validated());

        return response()->success( 'کد تخفیف با موفقیت ساخته شد' , new DiscountCodeResource($data) , 201);
    }
}
