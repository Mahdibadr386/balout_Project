<?php

namespace App\Repositories\Mysql;

use App\Interface\BranchRepositoryInterface;
use App\Models\Branch;

class BranchRepository implements BranchRepositoryInterface
{
    public function getAll()
    {
        return Branch::all();
    }
}
