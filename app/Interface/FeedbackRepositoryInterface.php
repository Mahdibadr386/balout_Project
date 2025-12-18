<?php

namespace App\Interface;

use App\Models\Feedback;

interface FeedbackRepositoryInterface
{
    /** Get all feedbacks with user and product, paginated */
    public function all();

    /** Find a feedback by ID with user and product */
    public function find(int $id);

    /** Approve a feedback */
    public function approve(Feedback $feedback);

    /** Delete a feedback */
    public function delete(Feedback $feedback): bool;

    /** Create or update a feedback for a user and product */
    public function storeFeedback(array $data, int $user_id);

    /** Delete a feedback by ID */
    public function destroyFeedback(int $id): bool;
}
