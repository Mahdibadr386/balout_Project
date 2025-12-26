<?php

namespace App\Http\Controllers\Public\Branch;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Branch\BranchResource;
use App\Interface\GetDateRepositoryInterface;


class IndexBranchesController extends Controller
{
    public function __invoke(GetDateRepositoryInterface $GetDateRepository)
    {
        $branches = $GetDateRepository->getBranches();
        return response()->success('لیست شعبات با موفقیت دریافت شد', BranchResource::collection($branches));
    }
}
