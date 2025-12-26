<?php

namespace App\Http\Controllers\Public\District;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserAddressResource;
use App\Http\Resources\Public\District\DistrictsResource;
use App\Interface\GetDateRepositoryInterface;
use Illuminate\Http\Request;

class IndexDistrictsController extends Controller
{
    public function __invoke(GetDateRepositoryInterface $getDateRepository , $id)
    {
        $data = $getDateRepository->getDistricts($id);

        return response()->success( 'ناحیه ها با موفقیت دریافت شد', DistrictsResource::collection($data) );

    }
}
