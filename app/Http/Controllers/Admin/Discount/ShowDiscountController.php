<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Discount\DiscountResource;
use App\Interface\DiscountRepositoryInterface;
use Illuminate\Http\Request;

class ShowDiscountController extends Controller
{
    public function __invoke(int $id, DiscountRepositoryInterface $DiscountRepository)
    {
        auth()->user()->hasPermissionTo('discount.show') ?: abort(403);

        return response()->success( ' تخفیف با موفقیت دریافت شد' , new DiscountResource($DiscountRepository->find($id) ));
    }
}
