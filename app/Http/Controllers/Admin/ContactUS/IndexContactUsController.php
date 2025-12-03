<?php

namespace App\Http\Controllers\Admin\ContactUS;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ContactUs\ContactUsResource;
use App\Repositories\Admin\ContactUs\ContactUsRepository;

class IndexContactUsController extends Controller
{
    public function __invoke(ContactUsRepository $ContactUsRepository)
    {
        return response()->success(ContactUsResource::collection($ContactUsRepository->all()), 'لیست آیتم‌ها با موفقیت دریافت شد', 200);
    }
}
