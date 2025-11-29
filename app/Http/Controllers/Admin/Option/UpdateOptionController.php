<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Option\UpdateOptionRequest;
use App\Http\Resources\Admin\Option\OptionResource;
use App\Repositories\Admin\Option\OptionRepository;
use Illuminate\Http\Request;

class UpdateOptionController extends Controller
{
    public function __construct(protected OptionRepository $repository) {}

    public function __invoke(UpdateOptionRequest $request, $id)
    {
        $option = $this->repository->find($id);
        if (!$option) return response()->error('گزینه موردنظر یافت نشد', null, 404);

        $option = $this->repository->update($option, $request->validated());
        return response()->success(new OptionResource($option), 'گزینه با موفقیت بروزرسانی شد' , 200);
    }
}
