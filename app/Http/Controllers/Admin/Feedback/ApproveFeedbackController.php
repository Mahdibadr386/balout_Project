<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Feedback\FeedbackResource;
use App\Repositories\Admin\Feedback\FeedbackRepository;
use Illuminate\Http\Request;

class ApproveFeedbackController extends Controller
{
    public function __construct(private FeedbackRepository $repository) {}

    public function __invoke(Request $request, $id)
    {
        $feedback = $this->repository->find($id);
        if (!$feedback) return response()->error('بازخورد یافت نشد', null, 404);

        $this->repository->approve($feedback);
        return response()->success(new FeedbackResource($feedback), 'بازخورد با موفقیت تایید شد', 200);

    }
}
