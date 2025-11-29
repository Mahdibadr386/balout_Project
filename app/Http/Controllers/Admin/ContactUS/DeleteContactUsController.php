<?php

namespace App\Http\Controllers\Admin\ContactUS;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ContactUs\ContactUsRepository;
use Illuminate\Http\Request;

class DeleteContactUsController extends Controller
{
    public function __construct(private ContactUsRepository $repository) {}

    public function __invoke($id)
    {
        $item = $this->repository->find($id);

        if (!$item) return response()->error('آیتم پیدا نشد', null, 404);


        $this->repository->delete($item);

        return response()->success(null, 'آیتم با موفقیت حذف شد', 200);

    }
}
