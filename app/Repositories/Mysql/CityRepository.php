<?php

namespace App\Repositories\Mysql;

use App\Interface\CityRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CityRepository implements CityRepositoryInterface
{
    public function IndexCities()
    {
        $data = DB::table('cities')->paginate(20);

        return $data;
    }
}
