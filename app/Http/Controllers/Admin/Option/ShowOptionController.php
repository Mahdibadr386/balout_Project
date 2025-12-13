<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Option\OptionResource;
use App\Repositories\Option\OptionRepositoryInterface;


class ShowOptionController extends Controller
{

    public function __invoke(OptionRepositoryInterface $OptionRepository, $id)
    {
        $option = $OptionRepository->find($id)?->load('details');
        return $option
            ? response()->success( 'جزئیات گزینه با موفقیت بارگذاری شد' , new OptionResource($option),)
            : response()->error('گزینه موردنظر یافت نشد');
    }

}
