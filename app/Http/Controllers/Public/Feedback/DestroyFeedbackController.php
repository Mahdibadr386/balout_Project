<?php

namespace App\Http\Controllers\Public\Feedback;

use App\Http\Controllers\Controller;
use App\Repositories\Public\Feedback\FeedbackRepository;
use Illuminate\Http\Request;

class DestroyFeedbackController extends Controller
{
    protected $feedbackRepository;

    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function __invoke(int $id)
    {
        $deleted = $this->feedbackRepository->destroyFeedback($id);

        if (!$deleted) return response()->error('بازخورد یافت نشد یا قبلاً حذف شده است.', null, 404);

        return response()->success(null, 'بازخورد با موفقیت حذف شد.', 200);
    }

}
