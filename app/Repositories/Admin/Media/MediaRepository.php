<?php

namespace App\Repositories\Admin\Media;

use App\Models\Media;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class MediaRepository
{
    public function store(Product $product, array $data)
    {
        $file = $data['file'];
        $collection = $data['collection_name'];


        $path = $file->store("products/{$product->id}/{$collection}", 'public');


        return $product->media()->create([
            'type' => $data['type'],
            'collection_name' => $collection,
            'file_name' => $file->getClientOriginalName(),
            'disk' => 'public',
            'path' => $path,
            'url' => asset("storage/{$path}"),
            'size' => $file->getSize(),
            'duration' => $data['duration'] ?? null,
            'alt' => $data['alt'] ?? null,
            'order_column' => $data['order_column'] ?? null,
        ]);
    }

    public function delete(Product $product, Media $media)
    {
        if ($media->model_id !== $product->id || $media->model_type !== Product::class) {
            return false;
        }

        Storage::disk($media->disk)->delete($media->path);
        $media->delete();

        return true;
    }
}
