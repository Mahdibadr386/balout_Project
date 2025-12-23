<?php

namespace App\Http\Controllers\Public\Branch;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Branch\BranchResource;
use App\Http\Resources\Public\Cart\CartItemResource;
use App\Interface\BranchRepositoryInterface;
use Illuminate\Http\Request;

class IndexBranchesController extends Controller
{
    public function __invoke(BranchRepositoryInterface $BranchRepository)
    {
        $branches = $BranchRepository->getAll();
        return response()->success('لیست شعبات با موفقیت دریافت شد', BranchResource::collection($branches));
    }
}
