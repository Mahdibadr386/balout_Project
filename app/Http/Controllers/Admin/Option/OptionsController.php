<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Option\OptionResource;
use App\Repositories\Admin\Option\OptionRepository;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    public function __construct(protected OptionRepository $repository) {}

    public function __invoke()
    {
        $options = $this->repository->all();

        return response()->success(OptionResource::collection($options), 'لیست گزینه‌ها با موفقیت بارگذاری شد' , 200);
    }
}
