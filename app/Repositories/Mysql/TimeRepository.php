<?php

namespace App\Repositories\Mysql;

use App\Interface\TimeRepositoryInterface;
use App\Models\Time;

class TimeRepository implements TimeRepositoryInterface
{
    public function getall()
    {
        return Time::all();
    }
}
