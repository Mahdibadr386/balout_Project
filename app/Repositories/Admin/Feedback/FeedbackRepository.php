<?php

namespace App\Repositories\Admin\Feedback;

use App\Models\Feedback;

class FeedbackRepository
{
    public function all()
    {
        return Feedback::with(['user','product'])
            ->whereHas('user')
            ->whereHas('product')
            ->latest()
            ->get();
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
}
