<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Feedback\FeedbackResource;
use App\Interface\FeedbackRepositoryInterface;
use Illuminate\Http\Request;

class ApproveFeedbackController extends Controller
{
    public function __invoke(FeedbackRepositoryInterface $FeedbackRepository ,Request $request, $id)
    {
        auth()->user()->hasPermissionTo('feedback.approve') ?: abort(403);
        $feedback = $FeedbackRepository->find($id);
        if (!$feedback) return response()->error('بازخورد یافت نشد');

        $FeedbackRepository->approve($feedback);
        return response()->success( 'بازخورد با موفقیت تایید شد' ,new FeedbackResource($feedback));

    }
}
