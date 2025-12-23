<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Discount\DiscountUsageResource;
use App\Interface\DiscountRepositoryInterface;
use Illuminate\Http\Request;

class UsageDiscountController extends Controller
{
    public function __invoke(DiscountRepositoryInterface $DiscountRepository)
    {
        auth()->user()->hasPermissionTo('discount.usages') ?: abort(403);

        return response()->success( 'لیست تخفیفات با موفقیت دریافت شد' , DiscountUsageResource::collection($DiscountRepository->usages()) );
    }
}
