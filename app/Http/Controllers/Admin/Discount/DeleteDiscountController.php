<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Discount\DiscountResource;
use App\Interface\DiscountRepositoryInterface;
use Illuminate\Http\Request;

class DeleteDiscountController extends Controller
{
    public function __invoke(DiscountRepositoryInterface $DiscountRepository ,  $id)
    {
        auth()->user()->hasPermissionTo('discount.delete') ?: abort(403);

        $discount = $DiscountRepository->find($id);
        $discount->delete();

        if($discount){
            return response()->success( ' تخفیف با موفقیت حذف شد' ) ;
        }
        return response()->error( ' تخفیف با موفقیت حذف نشد' ) ;

    }
}
