<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Option\UpdateOptionRequest;
use App\Http\Resources\Admin\Option\OptionResource;
use App\Repositories\Option\OptionRepositoryInterface;


class UpdateOptionController extends Controller
{
    public function __invoke( OptionRepositoryInterface $OptionRepository,UpdateOptionRequest $request, $id)
    {
        $option = $OptionRepository->find($id);
        if (!$option) return response()->error('گزینه موردنظر یافت نشد');

        $option = $OptionRepository->update($option, $request->validated());
        return response()->success( 'گزینه با موفقیت بروزرسانی شد' , new OptionResource($option));
    }
}
