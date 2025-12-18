<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Option\StoreOptionDetailRequest;
use App\Http\Resources\Admin\Option\OptionDetailResource;
use App\Interface\Option\OptionDetailRepositoryInterface;

class StoreOptionDetailController extends Controller
{
    public function __invoke(StoreOptionDetailRequest $request, OptionDetailRepositoryInterface $OptionDetailRepository)
    {
        auth()->user()->hasPermissionTo('option.detail.store') ?: abort(403);
        $details = $request->input('details', []);
        $createdDetails = $OptionDetailRepository->create($request->option_id, $details);

        return response()->success( 'جزئیات اپشن با موفقیت ایجاد شد', OptionDetailResource::collection(collect($createdDetails)),201);
    }
}
