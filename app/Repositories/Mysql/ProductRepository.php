<?php

namespace App\Repositories\Mysql;

use App\Interface\ProductRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(array $filters = [])
    {
        $perPage = $filters['per_page'] ?? 20;


        if (!empty($filters['search'])) {
            return Product::search($filters['search'])
                ->paginate($perPage);
        }

        return Product::orderBy('updated_at', 'desc')
            ->paginate($perPage);
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


    public function lockAndFind(int $id): ?Product
    {
        return Product::where('id', $id)->lockForUpdate()->first();
    }

    public function decrementStock(Product $product, int $quantity): void
    {
        $product->decrement('stock', $quantity);
    }

    public function incrementStock(Product $product, int $quantity): void
    {
        $product->increment('stock', $quantity);
    }


    public function categoryProducts(string $slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return null;
        }

        // Get available products of this Category
        return Product::with('Category')
            ->where('category_id', $category->id)
            ->where('available', true)
            ->orderBy('updated_at', 'desc')
            ->paginate(12);
    }

    public function product(string $slug)
    {
        $product = Product::with('Category')->where('slug', $slug)->where('available', true)->first();

        if (!$product) {
            return null;
        }

        return $product;
    }

    public function Products(array $filters = [])
    {
        $perPage = $filters['per_page'] ?? 12;

        if (!empty($filters['search'])) {

            $scout = Product::search($filters['search']);


            if (!empty($filters['category_slug'])) {
                $scout->where('category_slug', $filters['category_slug']);
            }

            $ids = $scout->keys();

            $query = Product::query()
                ->with('category')
                ->whereIn('id', $ids)
                ->where('available', true);

        } else {

            $query = Product::query()
                ->with('category')
                ->where('available', true);

            if (!empty($filters['category_slug'])) {
                $query->whereHas('category', function ($q) use ($filters) {
                    $q->where('slug', $filters['category_slug']);
                });
            }
        }

        if (!empty($filters['min_price'])) {
            $query->where('price_base', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price_base', '<=', $filters['max_price']);
        }

        $sort = $filters['sort'] ?? 'latest';
        match ($sort) {
            'price_asc'  => $query->orderBy('price_base', 'asc'),
            'price_desc' => $query->orderBy('price_base', 'desc'),
            'rate'       => $query->orderBy('rate', 'desc'),
            default      => $query->orderBy('updated_at', 'desc'),
        };

        return $query->paginate($perPage);
    }

}
