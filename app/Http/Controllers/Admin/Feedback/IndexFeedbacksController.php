<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Feedback\FeedbackResource;
use App\Repositories\Admin\Feedback\FeedbackRepository;

class IndexFeedbacksController extends Controller
{
    public function __invoke(FeedbackRepository $FeedbackRepository)
    {
        return response()->success(FeedbackResource::collection($FeedbackRepository->all()), 'لیست بازخوردها با موفقیت دریافت شد', 200);
    }
}
