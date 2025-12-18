<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Option\UpdateOptionDetailRequest;
use App\Http\Resources\Admin\Option\OptionDetailResource;
use App\Interface\Option\OptionDetailRepositoryInterface;

class UpdateOptionDetailController extends Controller
{
    public function __invoke(UpdateOptionDetailRequest $request, OptionDetailRepositoryInterface $OptionDetailRepository, $id)
    {
        auth()->user()->hasPermissionTo('option.detail.update') ?: abort(403);
        $item = $OptionDetailRepository->update($id, $request->validated());

        return response()->success( 'جزئیات گزینه با موفقیت ایجاد شد', new OptionDetailResource($item),201);
    }
}
