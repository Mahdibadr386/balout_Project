<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Feedback\FeedbackResource;
use App\Repositories\Admin\Feedback\FeedbackRepository;
use Illuminate\Http\Request;

class ApproveFeedbackController extends Controller
{
    public function __invoke(FeedbackRepository $FeedbackRepository ,Request $request, $id)
    {
        $feedback = $FeedbackRepository->find($id);
        if (!$feedback) return response()->error('بازخورد یافت نشد');

        $FeedbackRepository->approve($feedback);
        return response()->success( 'بازخورد با موفقیت تایید شد' ,new FeedbackResource($feedback));

    }
}
