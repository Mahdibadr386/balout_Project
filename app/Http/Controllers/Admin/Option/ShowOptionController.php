<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Option\OptionResource;
use App\Repositories\Admin\Option\OptionRepository;


class ShowOptionController extends Controller
{

    public function __invoke(OptionRepository $OptionRepository, $id)
    {
        $option = $OptionRepository->find($id)?->load('details');
        return $option
            ? response()->success(new OptionResource($option), 'جزئیات گزینه با موفقیت بارگذاری شد' , 200)
            : response()->error('گزینه موردنظر یافت نشد', null, 404);
    }

}
