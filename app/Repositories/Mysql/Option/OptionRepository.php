<?php

namespace App\Repositories\Mysql\Option;

use App\Interface\Option\OptionRepositoryInterface;
use App\Models\Option;

class OptionRepository implements OptionRepositoryInterface
{
    public function all(array $filters = [])
    {
        $perPage = $filters['per_page'] ?? 20;

        if (!empty($filters['search'])) {
            return Option::search($filters['search'])
                ->paginate($perPage);
        }

        return Option::with('details', 'messages')
            ->latest()
            ->paginate($perPage);
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
