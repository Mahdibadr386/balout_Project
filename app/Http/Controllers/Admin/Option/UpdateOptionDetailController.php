<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Option\UpdateOptionDetailRequest;
use App\Http\Resources\Admin\Option\OptionDetailResource;
use App\Repositories\Admin\Option\OptionDetailRepository;

class UpdateOptionDetailController extends Controller
{
    public function __invoke(UpdateOptionDetailRequest $request, OptionDetailRepository $OptionDetailRepository, $id)
    {
        $item = $OptionDetailRepository->update($id, $request->validated());

        return response()->success(new OptionDetailResource($item), 'جزئیات گزینه با موفقیت ایجاد شد', 201);
    }
}
