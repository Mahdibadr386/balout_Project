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

            return $product;
        });
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
