<?php

namespace App\Repositories\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductRepository
{
    public function all()
    {
        return Product::orderBy('updated_at', 'desc')->get();
    }

    public function find(int $id): ?Product
    {
        return Product::find($id);
    }

    public function create(array $data): Product
    {
        return DB::transaction(function () use ($data) {


            $product = Product::create($data);


            if (!empty($data['options'])) {
                $pivot = [];

                foreach ($data['options'] as $opt) {
                    $optionId = $opt['id'];
                    foreach ($opt['detail_id'] as $detailId) {
                        $pivot[] = [
                            'option_id' => $optionId,
                            'detail_id' => $detailId,
                            'product_id' => $product->id,
                        ];
                    }
                }

                DB::table('option_product')->insert($pivot);
            }

            if (!empty($data['images'])) {
                foreach ($data['images'] as $image) {
                    $product->addMedia($image)->toMediaCollection('images');
                }
            }

            return $product;
        });
    }


    public function update(Product $product, array $data): Product
    {
        return DB::transaction(function () use ($product, $data) {
            $product->update($data);


            $product->options()->detach();

            if (!empty($data['options'])) {
                $syncData = [];

                foreach ($data['options'] as $option) {
                    $optionId = $option['id'];
                    $detailIds = is_array($option['detail_id']) ? $option['detail_id'] : [$option['detail_id']];

                    foreach ($detailIds as $detailId) {
                        $syncData[] = [
                            'option_id' => $optionId,
                            'detail_id' => $detailId,
                        ];
                    }
                }
                foreach ($syncData as $row) {
                    $product->options()->attach($row['option_id'], [
                        'detail_id' => $row['detail_id']
                    ]);
                }
            }

            if (!empty($data['remove_images'])) {
                foreach ($data['remove_images'] as $mediaId) {
                    $media = $product->media()->find($mediaId);
                    if ($media) {
                        $media->delete();
                    }
                }
            }

            if (!empty($data['images'])) {
                foreach ($data['images'] as $image) {
                    $product->addMedia($image)->toMediaCollection('images');
                }
            }

            return $product;
        });
    }

    public function delete(Product $product): bool
    {
        return DB::transaction(function () use ($product) {

            $product->feedbacks()->delete();

            //delete medias
            $product->clearMediaCollection('images');

            return $product->delete();
        });
    }

    public function ActiveStatus(Product $product)
    {
        if ($product['available']){
            $product->update(['available' => false]);
        }else{
            $product->update(['available' => true]);
        }


        return $product;
    }


    public function pinProduct(int $id)
    {
        $product = $this->find($id);
        $product->touch();
        return $product;
    }
}
