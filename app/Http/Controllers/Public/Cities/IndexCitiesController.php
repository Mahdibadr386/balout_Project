<?php

namespace App\Http\Controllers\Public\Cities;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Http\Resources\Public\Cities\CitiesResource;
use App\Repositories\Public\CityRepository;
use Illuminate\Http\Request;

class IndexCitiesController extends Controller
{
    public function __invoke(CityRepository $CityRepository)
    {
        $data = $CityRepository->IndexCities();

        return response()->success( 'لیست شهر ها با موفقیت دریافت شد', CitiesResource::collection($data));
    }
}
