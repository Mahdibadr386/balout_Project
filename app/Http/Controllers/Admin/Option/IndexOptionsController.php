<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Option\OptionResource;
use App\Interface\Option\OptionRepositoryInterface;
use Illuminate\Http\Request;


class IndexOptionsController extends Controller
{
    public function __invoke(Request $request ,OptionRepositoryInterface $OptionRepository)
    {

        auth()->user()->hasPermissionTo('option.index') ?: abort(403);

        $filters = $request->only([
            'search',
        ]);

        $options = $OptionRepository->all($filters);

        return response()->success( 'لیست گزینه‌ها با موفقیت بارگذاری شد',OptionResource::collection($options) );
    }
}
