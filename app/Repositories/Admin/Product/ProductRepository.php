<?php

namespace App\Repositories\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductRepository
{
    public function all()
    {
        return Product::with('category')->latest()->get();
    }

    public function find(int $id): ?Product
    {
        return Product::with('category')->find($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product): bool
    {
        return DB::transaction(function () use ($product) {

            $product->feedbacks()->delete();

            //delete medias
            foreach ($product->media as $media) {
                if (Storage::disk($media->disk)->exists($media->path)) {
                    Storage::disk($media->disk)->delete($media->path);
                }
            }
            $product->media()->delete();


            return $product->delete();
        });
    }
}
