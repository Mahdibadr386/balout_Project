<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Repositories\Option\OptionRepositoryInterface;


class DeleteOptionController extends Controller
{
    public function __invoke(OptionRepositoryInterface $OptionRepository,$id)
    {
        $option = $OptionRepository->find($id);
        if (!$option) return response()->error('گزینه موردنظر یافت نشد');

        $OptionRepository->delete($option);
        return response()->success( 'گزینه با موفقیت حذف شد');
    }
}
