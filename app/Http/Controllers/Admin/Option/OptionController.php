<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Option\OptionResource;
use App\Repositories\Admin\Option\OptionRepository;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function __construct(protected OptionRepository $repository) {}

    public function __invoke($id)
    {
        $option = $this->repository->find($id)?->load('details');
        return $option
            ? response()->success(new OptionResource($option), 'جزئیات گزینه با موفقیت بارگذاری شد' , 200)
            : response()->error('گزینه موردنظر یافت نشد', null, 404);
    }

}
