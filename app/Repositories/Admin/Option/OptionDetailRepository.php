<?php

namespace App\Repositories\Admin\Option;

use App\Models\OptionDetail;

class OptionDetailRepository
{
    public function find($id)
    {
        return OptionDetail::findOrFail($id);
    }

    public function create(array $data)
    {
        return OptionDetail::create($data);
    }

    public function update($id, array $data)
    {
        $item = $this->find($id);
        $item->update($data);

        return $item;
    }

    public function delete($id)
    {
        $item = $this->find($id);
        return $item->delete();
    }
}
