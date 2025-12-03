<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Feedback\FeedbackRepository;


class DeleteFeedbackController extends Controller
{
    public function __invoke(FeedbackRepository $FeedbackRepository ,$id)
    {
        $feedback = $FeedbackRepository->find($id);
        if (!$feedback) {
            return response()->error('بازخورد یافت نشد', null, 404);
        }

        $FeedbackRepository->delete($feedback);
        return response()->success(null, 'بازخورد با موفقیت حذف شد', 200);

    }
}
