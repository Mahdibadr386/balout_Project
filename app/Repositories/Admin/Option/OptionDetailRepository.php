<?php

namespace App\Repositories\Admin\Option;

use App\Models\OptionDetail;
use Illuminate\Support\Facades\DB;

class OptionDetailRepository
{
    public function find($id)
    {
        return OptionDetail::findOrFail($id);
    }

    public function create(int $optionId, array $details)
    {
        return DB::transaction(function () use ($optionId, $details) {
            $created = [];

            foreach ($details as $detail) {
                $created[] = OptionDetail::create([
                    'option_id' => $optionId,
                    'name'      => $detail['name'],
                    'price'     => $detail['price'],
                ]);
            }

            return $created;
        });
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
