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

        if (!$feedback) return response()->error('بازخورد موردنظر یافت نشد', null, 404); return response()->success(new FeedbackResource($feedback), 'بازخورد با موفقیت دریافت شد', 200);

    }
}
