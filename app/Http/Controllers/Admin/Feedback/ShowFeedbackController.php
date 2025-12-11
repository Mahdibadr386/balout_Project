<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Feedback\FeedbackResource;
use App\Repositories\Admin\Feedback\FeedbackRepository;


class ShowFeedbackController extends Controller
{
    public function __invoke(FeedbackRepository $FeedbackRepository,$id)
    {
        $feedback = $FeedbackRepository->find($id);

        if (!$feedback) return response()->error('بازخورد موردنظر یافت نشد'); return response()->success( 'بازخورد با موفقیت دریافت شد',new FeedbackResource($feedback),);

    }
}
