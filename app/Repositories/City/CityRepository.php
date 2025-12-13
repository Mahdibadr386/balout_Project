<?php

namespace App\Repositories\City;

use Illuminate\Support\Facades\DB;

class CityRepository implements CityRepositoryInterface
{
    public function IndexCities()
    {
        $data = DB::table('cities')->paginate(20);

        return $data;
    }
}
