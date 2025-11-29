<?php

namespace App\Repositories\Admin\Option;

use App\Models\Option;

class OptionRepository
{
    public function all()
    {
        return Option::latest()->get();
    }

    public function find(int $id): ?Option
    {
        return Option::find($id);
    }

    public function create(array $data): Option
    {
        return Option::create($data);
    }

    public function update(Option $option, array $data): Option
    {
        $option->update($data);
        return $option;
    }

    public function delete(Option $option): bool
    {
        return $option->delete();
    }
}
