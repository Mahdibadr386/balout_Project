<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Discount\StoreDiscountRequest;
use App\Http\Requests\Admin\Discount\UpdateDiscountRequest;
use App\Http\Resources\Admin\Discount\DiscountResource;
use App\Interface\DiscountRepositoryInterface;
use Illuminate\Http\Request;

class UpdateDiscountController extends Controller
{
    public function __invoke(int $id, UpdateDiscountRequest $request, DiscountRepositoryInterface $DiscountRepository)
    {
        auth()->user()->hasPermissionTo('discount.update') ?: abort(403);

        $discount = $DiscountRepository->update($id, $request->validated());
        return response()->success( ' تخفیف با موفقیت بروزرسانی شد' , new DiscountResource($discount)) ;
    }
}
