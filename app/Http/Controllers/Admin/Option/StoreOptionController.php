<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Option\StoreOptionRequest;
use App\Http\Resources\Admin\Option\OptionResource;
use App\Repositories\Admin\Option\OptionRepository;
use Illuminate\Http\Request;

class StoreOptionController extends Controller
{
    public function __invoke(OptionRepository $OptionRepository ,StoreOptionRequest $request)
    {
        $option = $OptionRepository->create($request->validated());
        return response()->success(new OptionResource($option), 'گزینه جدید با موفقیت ایجاد شد', 201);
    }

}
