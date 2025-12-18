<?php

namespace App\Http\Controllers\Admin\ContactUS;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ContactUs\ContactUsResource;
use App\Interface\ContactUsRepositoryInterface;

class ShowContactUsController extends Controller
{
    public function __invoke(ContactUsRepositoryInterface $ContactUsRepository,$id)
    {
        auth()->user()->hasPermissionTo('contact_us.show') ?: abort(403);
        $item = $ContactUsRepository->find($id);

        if (!$item) return response()->error('آیتم پیدا نشد');

        return response()->success( 'آیتم با موفقیت دریافت شد',new ContactUsResource($item),);


    }
}
