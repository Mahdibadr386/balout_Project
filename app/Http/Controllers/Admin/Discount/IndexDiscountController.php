<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Discount\DiscountResource;
use App\Interface\DiscountRepositoryInterface;
use Illuminate\Http\Request;

class IndexDiscountController extends Controller
{
    public function __invoke(DiscountRepositoryInterface $DiscountRepository)
    {
        auth()->user()->hasPermissionTo('discount.index') ?: abort(403);

        return response()->success( 'لیست تخفیفات با موفقیت دریافت شد' , DiscountResource::collection($DiscountRepository->paginate()) );
    }
}
