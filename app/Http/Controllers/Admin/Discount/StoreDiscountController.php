<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Discount\StoreDiscountRequest;
use App\Http\Resources\Admin\Discount\DiscountResource;
use App\Interface\DiscountRepositoryInterface;
use Illuminate\Http\Request;

class StoreDiscountController extends Controller
{
    public function __invoke(StoreDiscountRequest $request, DiscountRepositoryInterface $DiscountRepository)
    {
        auth()->user()->hasPermissionTo('discount.store') ?: abort(403);

        $discount = $DiscountRepository->store($request->validated());

        return response()->success( ' تخفیف با موفقیت ساخته شد' , new DiscountResource($discount) ,201) ;
    }
}
