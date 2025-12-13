<?php

namespace App\Http\Controllers\Admin\ContactUS;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ContactUs\ContactUsResource;
use App\Repositories\ContactUs\ContactUsRepositoryInterface;

class ShowContactUsController extends Controller
{
    public function __invoke(ContactUsRepositoryInterface $ContactUsRepository,$id)
    {
        $item = $ContactUsRepository->find($id);

        if (!$item) return response()->error('آیتم پیدا نشد');

        return response()->success( 'آیتم با موفقیت دریافت شد',new ContactUsResource($item),);


    }
}
