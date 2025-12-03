<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Option\StoreOptionDetailRequest;
use App\Http\Resources\Admin\Option\OptionDetailResource;
use App\Repositories\Admin\Option\OptionDetailRepository;

class StoreOptionDetailController extends Controller
{
    public function __invoke(StoreOptionDetailRequest $request, OptionDetailRepository $OptionDetailRepository)
    {
        $item = $OptionDetailRepository->create($request->validated());

        return response()->success(new OptionDetailResource($item), 'جزئیات گزینه با موفقیت ایجاد شد', 201);
    }
}
