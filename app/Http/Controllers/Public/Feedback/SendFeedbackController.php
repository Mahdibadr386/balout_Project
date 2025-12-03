<?php

namespace App\Http\Controllers\Public\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Feedback\StoreFeedbackRequest;
use App\Http\Resources\Public\Feedback\FeedbackResource;
use App\Repositories\Public\Feedback\FeedbackRepository;

class SendFeedbackController extends Controller
{
    public function __invoke(FeedbackRepository $feedbackRepository , StoreFeedbackRequest $request)
    {
        $data = $request->validated();
        $user_id = auth()->id();
        $feedback = $feedbackRepository->storeFeedback($data , $user_id);

        return response()->success(new FeedbackResource($feedback), 'بازخورد با موفقیت ارسال شد.', 201);
    }
}
