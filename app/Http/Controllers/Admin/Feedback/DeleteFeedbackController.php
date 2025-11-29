<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Feedback\FeedbackRepository;
use Illuminate\Http\Request;

class DeleteFeedbackController extends Controller
{
    public function __construct(private FeedbackRepository $repository) {}

    public function __invoke($id)
    {
        $feedback = $this->repository->find($id);
        if (!$feedback) {
            return response()->error('بازخورد یافت نشد', null, 404);
        }

        $this->repository->delete($feedback);
        return response()->success(null, 'بازخورد با موفقیت حذف شد', 200);

    }
}
