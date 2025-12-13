<?php

namespace App\Repositories\Option;

use App\Models\Option;

interface OptionRepositoryInterface
{
    /** Get all options with their details and messages */
    public function all();

    /** Find an option by ID with details and messages */
    public function find(int $id): ?Option;

    /** Create a new option */
    public function create(array $data): Option;

    /** Update an existing option */
    public function update(Option $option, array $data): Option;

    /** Delete an option */
    public function delete(Option $option): bool;
}
