<?php

namespace App\Http\Controllers\Public\Cities;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Cities\CitiesResource;
use App\Interface\CityRepositoryInterface;

class IndexCitiesController extends Controller
{
    public function __invoke(CityRepositoryInterface $CityRepository)
    {
        $data = $CityRepository->IndexCities();

        return response()->success( 'لیست شهر ها با موفقیت دریافت شد', CitiesResource::collection($data));
    }
}
