<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Feedback\FeedbackResource;
use App\Repositories\Admin\Feedback\FeedbackRepository;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function __construct(private FeedbackRepository $repository) {}

    public function __invoke($id)
    {
        $feedback = $this->repository->find($id);

        if (!$feedback) return response()->error('بازخورد موردنظر یافت نشد', null, 404); return response()->success(new FeedbackResource($feedback), 'بازخورد با موفقیت دریافت شد', 200);

    }
}
