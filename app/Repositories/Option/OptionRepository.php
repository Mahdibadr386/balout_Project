<?php

namespace App\Repositories\Option;

use App\Models\Option;

class OptionRepository implements OptionRepositoryInterface
{
    public function all()
    {
        return Option::with('details', 'messages')->latest()->paginate(20);
    }

    public function find(int $id): ?Option
    {
        return Option::with('details', 'messages')->find($id);
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
