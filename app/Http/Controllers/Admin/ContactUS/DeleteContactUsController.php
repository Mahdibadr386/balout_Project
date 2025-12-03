<?php

namespace App\Http\Controllers\Admin\ContactUS;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ContactUs\ContactUsRepository;


class DeleteContactUsController extends Controller
{
    public function __invoke(ContactUsRepository $ContactUsRepository, $id)
    {
        $item = $ContactUsRepository->find($id);

        if (!$item) return response()->error('آیتم پیدا نشد', null, 404);


        $ContactUsRepository->delete($item);

        return response()->success(null, 'آیتم با موفقیت حذف شد', 200);

    }
}
