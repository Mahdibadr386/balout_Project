<?php

namespace App\Http\Controllers\Admin\ContactUS;

use App\Http\Controllers\Controller;
use App\Interface\ContactUsRepositoryInterface;


class DeleteContactUsController extends Controller
{
    public function __invoke(ContactUsRepositoryInterface $ContactUsRepository, $id)
    {
        auth()->user()->hasPermissionTo('contact_us.delete') ?: abort(403);
        $item = $ContactUsRepository->find($id);

        if (!$item) return response()->error('آیتم پیدا نشد');


        $ContactUsRepository->delete($item);

        return response()->success( 'آیتم با موفقیت حذف شد');

    }
}
