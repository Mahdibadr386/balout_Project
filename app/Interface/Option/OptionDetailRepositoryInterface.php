<?php

namespace App\Interface\Option;

interface OptionDetailRepositoryInterface
{
    /** Find an option detail by ID */
    public function find($id);

    /** Create multiple option details for a given option */
    public function create(int $optionId, array $details);

    /** Update an option detail by ID */
    public function update($id, array $data);

    /** Delete an option detail by ID */
    public function delete($id);
}
