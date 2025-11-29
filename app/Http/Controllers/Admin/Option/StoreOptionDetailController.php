<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Option\StoreOptionDetailRequest;
use App\Http\Resources\Admin\Option\OptionDetailResource;
use App\Repositories\Admin\Option\OptionDetailRepository;
use Illuminate\Http\Request;

class StoreOptionDetailController extends Controller
{
    public function __invoke(StoreOptionDetailRequest $request, OptionDetailRepository $repo)
    {
        $item = $repo->create($request->validated());

        return response()->success(new OptionDetailResource($item), 'جزئیات گزینه با موفقیت ایجاد شد', 201);
    }
}
