<?php

namespace App\Repositories\Admin\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryRepository
{
    /**
     * Paginate categories with optional per-page limit.
     */
    public function paginate(int $perPage = 20)
    {
        return Category::orderBy('sort_order')->paginate($perPage);
    }

    /**
     * Find category by ID or return null.
     */
    public function find(int $id): ?Category
    {
        return Category::find($id);
    }

    /**
     * Create a new category.
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Update a category by ID.
     * Throws ModelNotFoundException if category not found.
     */
    public function update(int $id, array $data): Category
    {
        $category = $this->findOrFail($id);
        $category->update($data);

        return $category;
    }

    /**
     * Delete a category by ID.
     * Throws ModelNotFoundException if category not found.
     */
    public function delete(int $id): bool
    {
        $category = $this->findOrFail($id);
        return $category->delete();
    }

    /**
     * Find category or throw ModelNotFoundException.
     */
    protected function findOrFail(int $id): Category
    {
        $category = $this->find($id);

        if (!$category) {
            throw new ModelNotFoundException("دسته‌بندی با شناسه {$id} پیدا نشد.");
        }

        return $category;
    }
}
