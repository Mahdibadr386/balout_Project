<?php

namespace App\Repositories\Mysql;

use App\Interface\ContactUsRepositoryInterface;
use App\Models\ContactUs;

class ContactUsRepository implements ContactUsRepositoryInterface
{
    public function all()
    {
        return ContactUs::latest()->paginate(20);
    }

    public function find(int $id): ?ContactUs
    {
        return ContactUs::find($id);
    }

    public function delete(ContactUs $item): bool
    {
        return $item->delete();
    }

    public function StoreContact(array $data)
    {
        $result = ContactUs::UpdateOrCreate($data);
        return $result;
    }
}
