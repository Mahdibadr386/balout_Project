<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Option\OptionRepository;
use Illuminate\Http\Request;

class DeleteOptionController extends Controller
{
    public function __construct(protected OptionRepository $repository) {}

    public function __invoke($id)
    {
        $option = $this->repository->find($id);
        if (!$option) return response()->error('گزینه موردنظر یافت نشد', null, 404);

        $this->repository->delete($option);
        return response()->success(null, 'گزینه با موفقیت حذف شد');
    }
}
