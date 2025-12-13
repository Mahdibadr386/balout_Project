<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Repositories\Option\OptionDetailRepositoryInterface;
use Illuminate\Http\Request;

class DeleteOptionDetailController extends Controller
{
    public function __invoke(Request $request, OptionDetailRepositoryInterface $OptionDetailRepository, $id)
    {
        $OptionDetailRepository->delete($id);

        return response()->success( 'جزئیات گزینه با موفقیت حذف شد');
    }
}
