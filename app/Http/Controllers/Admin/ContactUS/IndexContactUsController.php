<?php

namespace App\Http\Controllers\Admin\ContactUS;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ContactUs\ContactUsResource;
use App\Interface\ContactUsRepositoryInterface;

class IndexContactUsController extends Controller
{
    public function __invoke(ContactUsRepositoryInterface $ContactUsRepository)
    {
        auth()->user()->hasPermissionTo('contact_us.index') ?: abort(403);
        return response()->success( 'لیست آیتم‌ها با موفقیت دریافت شد',ContactUsResource::collection($ContactUsRepository->all()),);
    }
}
