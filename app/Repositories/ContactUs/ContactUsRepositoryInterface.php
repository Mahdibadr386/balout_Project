<?php

namespace App\Repositories\ContactUs;

use App\Models\ContactUs;

interface ContactUsRepositoryInterface
{
    /** Get all contact messages, ordered by latest */
    public function all();

    /** Find a contact message by ID */
    public function find(int $id): ?ContactUs;

    /** Delete a contact message */
    public function delete(ContactUs $item): bool;

    /** Create or update a contact message */
    public function StoreContact(array $data);
}
