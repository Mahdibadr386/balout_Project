<?php

namespace App\Interface;

use App\Models\Category;


interface CategoryRepositoryInterface
{
    /** Get all categories with their children recursively */
    public function all();

    /** Get all active categories with their immediate children */
    public function active();

    /** Find a category by its ID */
    public function find(int $id): ?Category;

    /** Create a new category */
    public function create(array $data): Category;

    /** Update an existing category */
    public function update(int $id, array $data): Category;

    /** Delete a category and its related options, details, and messages */
    public function delete(int $id): bool;

    /** Get all options for a given category */
    public function getCategoryOptions(int $id);
}
