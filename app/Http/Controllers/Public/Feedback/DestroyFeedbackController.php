<?php

namespace App\Http\Controllers\Public\Feedback;

use App\Http\Controllers\Controller;
use App\Repositories\Public\Feedback\FeedbackRepository;

class DestroyFeedbackController extends Controller
{
    public function __invoke(FeedbackRepository $feedbackRepository , int $id)
    {
        $deleted = $feedbackRepository->destroyFeedback($id);

        if (!$deleted) return response()->error('بازخورد یافت نشد یا قبلاً حذف شده است.');

        return response()->success('بازخورد با موفقیت حذف شد.');
    }

}
