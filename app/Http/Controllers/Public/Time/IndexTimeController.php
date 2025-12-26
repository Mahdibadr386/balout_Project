<?php

namespace App\Http\Controllers\Public\Time;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Time\TimeResource;
use App\Interface\GetDateRepositoryInterface;

class IndexTimeController extends Controller
{
    public function __invoke(GetDateRepositoryInterface $GetDateRepository)
    {
        $times = $GetDateRepository->getTimes();
        return response()->success( 'ساعات زمانی با موفقیت دریافت شد', TimeResource::collection($times) );
    }
}
