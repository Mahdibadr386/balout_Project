<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Option\OptionResource;
use App\Repositories\Admin\Option\OptionRepository;


class IndexOptionsController extends Controller
{
    public function __invoke(OptionRepository $OptionRepository)
    {
        $options = $OptionRepository->all();

        return response()->success( 'لیست گزینه‌ها با موفقیت بارگذاری شد',OptionResource::collection($options) );
    }
}
