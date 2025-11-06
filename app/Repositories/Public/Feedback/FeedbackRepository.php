<?php

namespace App\Repositories\Public\Feedback;

use App\Models\Feedback;

class FeedbackRepository
{
    public function storeFeedback(array $data)
    {
        return Feedback::updateOrCreate(
            [
                'user_id'    => $data['user_id'],
                'product_id' => $data['product_id'],
            ],
            [
                'comment'  => $data['comment'],
                'rate'     => $data['rate'],
                'approved' => false,
            ]
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
