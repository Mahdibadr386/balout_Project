<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Option\OptionResource;
use App\Repositories\Option\OptionRepositoryInterface;


class IndexOptionsController extends Controller
{
    public function __invoke(OptionRepositoryInterface $OptionRepository)
    {
        $options = $OptionRepository->all();

        return response()->success( 'لیست گزینه‌ها با موفقیت بارگذاری شد',OptionResource::collection($options) );
    }
}
