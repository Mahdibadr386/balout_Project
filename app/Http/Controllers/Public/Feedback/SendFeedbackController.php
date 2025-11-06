<?php

namespace App\Http\Controllers\Public\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Feedback\StoreFeedbackRequest;
use App\Http\Resources\Public\Feedback\FeedbackResource;
use App\Repositories\Public\Feedback\FeedbackRepository;
use Illuminate\Http\Request;

class SendFeedbackController extends Controller
{
    protected $feedbackRepository;

    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function __invoke(StoreFeedbackRequest $request)
    {
        $data = $request->validated();
        $feedback = $this->feedbackRepository->storeFeedback($data);

        return response()->success(new FeedbackResource($feedback), 'بازخورد با موفقیت ارسال شد.', 201);
    }
}
