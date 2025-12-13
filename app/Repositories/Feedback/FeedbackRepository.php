<?php

namespace App\Repositories\Feedback;

use App\Models\Feedback;

class FeedbackRepository implements FeedbackRepositoryInterface
{
    public function all()
    {
        return Feedback::with(['user','product'])
            ->whereHas('user')
            ->whereHas('product')
            ->latest()
            ->paginate(20);
    }

    public function find(int $id)
    {
        return Feedback::with(['user', 'product'])->find($id);
    }

    public function approve(Feedback $feedback)
    {
        $feedback->update(['approved' => true]);
        return $feedback;
    }

    public function delete(Feedback $feedback): bool
    {
        return $feedback->delete();
    }


    public function storeFeedback(array $data , int $user_id)
    {
        return Feedback::create(
            [
                'user_id'    => $user_id,
                'product_id' => $data['product_id'],
                'comment'  => $data['comment'],
                'rate'     => $data['rate'],
                'approved' => false,
            ],
        );
    }

    public function destroyFeedback(int $id): bool
    {
        $feedback = Feedback::find($id);

        if (!$feedback) {
            return false; // feedback not found
        }
        return $feedback->delete();
    }
}
