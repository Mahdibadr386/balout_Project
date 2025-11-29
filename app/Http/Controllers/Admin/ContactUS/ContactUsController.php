<?php

namespace App\Http\Controllers\Admin\ContactUS;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ContactUs\ContactUsResource;
use App\Repositories\Admin\ContactUs\ContactUsRepository;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function __construct(private ContactUsRepository $repository) {}

    public function __invoke($id)
    {
        $item = $this->repository->find($id);

        if (!$item) return response()->error('آیتم پیدا نشد', null, 404);

        return response()->success(new ContactUsResource($item), 'آیتم با موفقیت دریافت شد', 200);


    }
}
