<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Feedback\FeedbackResource;
use App\Interface\FeedbackRepositoryInterface;


class ShowFeedbackController extends Controller
{
    public function __invoke(FeedbackRepositoryInterface $FeedbackRepository,$id)
    {
        auth()->user()->hasPermissionTo('feedback.show') ?: abort(403);
        $feedback = $FeedbackRepository->find($id);

        if (!$feedback) return response()->error('بازخورد موردنظر یافت نشد'); return response()->success( 'بازخورد با موفقیت دریافت شد',new FeedbackResource($feedback),);

    }
}
