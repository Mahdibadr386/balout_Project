<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Models\Option;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return Category::with('childrenRecursive')
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->get();
    }

    public function active()
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        return $categories;
    }
    public function find(int $id): ?Category
    {
        return Category::find($id);
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }


    public function update(int $id, array $data): Category
    {
        $category = $this->findOrFail($id);
        $category->update($data);

        return $category;
    }

    public function delete(int $id): bool
    {
        $category = $this->findOrFail($id);
        return DB::transaction(function () use ($category) {

            foreach ($category->options as $option) {
                $option->details()->delete();
                $option->messages()->delete();
                $option->delete();
            }
            return $category->delete();
        });
    }



    protected function findOrFail(int $id): Category
    {
        $category = $this->find($id);

        if (!$category) {
            throw new ModelNotFoundException("دسته‌بندی با شناسه {$id} پیدا نشد.");
        }

        return $category;
    }

    public function getCategoryOptions(int $id)
    {
        $result = Option::with('details')
            ->where('category_id', $id)
            ->get();
        return $result;
    }
}
