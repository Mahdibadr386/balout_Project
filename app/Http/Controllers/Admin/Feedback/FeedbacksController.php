<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Feedback\FeedbackResource;
use App\Repositories\Admin\Feedback\FeedbackRepository;

class FeedbacksController extends Controller
{
    public function __construct(private FeedbackRepository $repository) {}

    public function __invoke()
    {
        return response()->success(FeedbackResource::collection($this->repository->all()), 'لیست بازخوردها با موفقیت دریافت شد', 200);
    }
}
