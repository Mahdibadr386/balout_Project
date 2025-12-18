<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Option\OptionResource;
use App\Interface\Option\OptionRepositoryInterface;


class ShowOptionController extends Controller
{

    public function __invoke(OptionRepositoryInterface $OptionRepository, $id)
    {
        auth()->user()->hasPermissionTo('option.show') ?: abort(403);
        $option = $OptionRepository->find($id)?->load('details');
        return $option
            ? response()->success( 'جزئیات گزینه با موفقیت بارگذاری شد' , new OptionResource($option),)
            : response()->error('گزینه موردنظر یافت نشد');
    }

}
