<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Option\StoreOptionRequest;
use App\Http\Resources\Admin\Option\OptionResource;
use App\Repositories\Option\OptionRepositoryInterface;

class StoreOptionController extends Controller
{
    public function __invoke(OptionRepositoryInterface $OptionRepository ,StoreOptionRequest $request)
    {
        $option = $OptionRepository->create($request->validated());
        return response()->success( 'گزینه جدید با موفقیت ایجاد شد', new OptionResource($option),201);
    }

}
