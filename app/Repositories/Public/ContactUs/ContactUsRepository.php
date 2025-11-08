<?php

namespace App\Repositories\Public\ContactUs;

use App\Models\ContactUs;

class ContactUsRepository
{
    public function StoreContact(array $data)
    {
        $result = ContactUs::UpdateOrCreate($data);
        return $result;
    }

}
