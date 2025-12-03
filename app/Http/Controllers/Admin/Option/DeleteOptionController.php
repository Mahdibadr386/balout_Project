<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Option\OptionRepository;


class DeleteOptionController extends Controller
{
    public function __invoke(OptionRepository $OptionRepository,$id)
    {
        $option = $OptionRepository->find($id);
        if (!$option) return response()->error('گزینه موردنظر یافت نشد', null, 404);

        $OptionRepository->delete($option);
        return response()->success(null, 'گزینه با موفقیت حذف شد');
    }
}
