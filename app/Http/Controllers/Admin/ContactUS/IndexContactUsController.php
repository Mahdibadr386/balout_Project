<?php

namespace App\Http\Controllers\Admin\ContactUS;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ContactUs\ContactUsResource;
use App\Repositories\ContactUs\ContactUsRepositoryInterface;

class IndexContactUsController extends Controller
{
    public function __invoke(ContactUsRepositoryInterface $ContactUsRepository)
    {
        return response()->success( 'لیست آیتم‌ها با موفقیت دریافت شد',ContactUsResource::collection($ContactUsRepository->all()),);
    }
}
