<?php

namespace App\Repositories\Mysql;

use App\Interface\GetDateRepositoryInterface;
use App\Models\Branch;
use App\Models\District;
use App\Models\Time;
use Illuminate\Support\Facades\DB;

class GetDateRepository implements GetDateRepositoryInterface
{
    public function getBranches()
    {
        return Branch::all();
    }

    public function getCities()
    {
        $data = DB::table('cities')->paginate(20);

        return $data;
    }

    public function getDistricts(int $cityId)
    {
        $data = District::where('city_id', $cityId)->get();
        return $data;
    }

    public function getTimes()
    {
        return Time::all();

    }
}
