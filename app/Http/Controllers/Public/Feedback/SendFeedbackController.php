<?php

namespace App\Http\Controllers\Public\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Feedback\StoreFeedbackRequest;
use App\Http\Resources\Public\Feedback\FeedbackResource;
use App\Interface\FeedbackRepositoryInterface;

class SendFeedbackController extends Controller
{
    public function __invoke(FeedbackRepositoryInterface $feedbackRepository , StoreFeedbackRequest $request)
    {
        $data = $request->validated();
        $user_id = auth()->id();
        $feedback = $feedbackRepository->storeFeedback($data , $user_id);

        return response()->success( 'بازخورد با موفقیت ارسال شد.',new FeedbackResource($feedback), 201);
    }
}
