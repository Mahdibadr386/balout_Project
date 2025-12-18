<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Feedback\FeedbackResource;
use App\Interface\FeedbackRepositoryInterface;

class IndexFeedbacksController extends Controller
{
    public function __invoke(FeedbackRepositoryInterface $FeedbackRepository)
    {
        auth()->user()->hasPermissionTo('feedback.index') ?: abort(403);
        return response()->success( 'لیست بازخوردها با موفقیت دریافت شد' ,FeedbackResource::collection($FeedbackRepository->all()));
    }
}
