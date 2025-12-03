<?php

namespace App\Http\Controllers\Admin\ContactUS;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ContactUs\ContactUsResource;
use App\Repositories\Admin\ContactUs\ContactUsRepository;

class ShowContactUsController extends Controller
{
    public function __invoke(ContactUsRepository $ContactUsRepository,$id)
    {
        $item = $ContactUsRepository->find($id);

        if (!$item) return response()->error('آیتم پیدا نشد', null, 404);

        return response()->success(new ContactUsResource($item), 'آیتم با موفقیت دریافت شد', 200);


    }
}
