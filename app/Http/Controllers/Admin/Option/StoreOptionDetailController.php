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
        $details = $request->input('details', []);
        $createdDetails = $OptionDetailRepository->create($request->option_id, $details);

        return response()->success( 'جزئیات اپشن با موفقیت ایجاد شد', OptionDetailResource::collection(collect($createdDetails)),201);
    }
}
