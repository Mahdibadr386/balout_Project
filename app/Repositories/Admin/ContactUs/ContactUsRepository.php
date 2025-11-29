<?php

namespace App\Repositories\Admin\ContactUs;

use App\Models\ContactUs;

class ContactUsRepository
{
    public function all()
    {
        return ContactUs::latest()->get();
    }

    public function find(int $id): ?ContactUs
    {
        return ContactUs::find($id);
    }

    public function delete(ContactUs $item): bool
    {
        return $item->delete();
    }
}
