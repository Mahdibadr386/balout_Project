<?php

namespace App\Http\Controllers\Public\Time;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Product\ProductCollection;
use App\Http\Resources\Public\Time\TimeResource;
use App\Interface\TimeRepositoryInterface;
use Illuminate\Http\Request;

class IndexTimeController extends Controller
{
    public function __invoke(TimeRepositoryInterface $TimeRepository)
    {
        $times = $TimeRepository->getAll();
        return response()->success( 'ساعات زمانی با موفقیت دریافت شد', TimeResource::collection($times) );
    }
}
