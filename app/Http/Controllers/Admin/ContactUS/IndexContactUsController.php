<?php

namespace App\Http\Controllers\Admin\ContactUS;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ContactUs\ContactUsResource;
use App\Repositories\Admin\ContactUs\ContactUsRepository;
use Illuminate\Http\Request;

class IndexContactUsController extends Controller
{
    public function __construct(private ContactUsRepository $repository) {}

    public function __invoke()
    {
        return response()->success(ContactUsResource::collection($this->repository->all()), 'لیست آیتم‌ها با موفقیت دریافت شد', 200);
    }
}
