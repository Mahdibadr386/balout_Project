<?php

namespace App\Repositories\Public;

use Illuminate\Support\Facades\DB;

class CityRepository
{
    public function IndexCities()
    {
        $data = DB::table('cities')->get();

        return $data;
    }
}
