<?php

namespace App\Repositories\Product;

use App\Models\Product;

interface ProductRepositoryInterface
{
    /** Get all products paginated */
    public function all();

    /** Find a product by ID */
    public function find(int $id): ?Product;

    /** Create a new product */
    public function create(array $data): Product;

    /** Update an existing product */
    public function update(Product $product, array $data): Product;

    /** Delete a product */
    public function delete(Product $product): bool;

    /** Toggle active status of a product */
    public function ActiveStatus(Product $product);

    /** Update product timestamp to pin it */
    public function pinProduct(int $id);

    /** Lock a product row for update */
    public function lockAndFind(int $id): ?Product;

    /** Decrement product stock */
    public function decrementStock(Product $product, int $quantity): void;

    /** Increment product stock */
    public function incrementStock(Product $product, int $quantity): void;

    /** Get available products of a category by slug */
    public function categoryProducts(string $slug);

    /** Get all available products paginated */
    public function products();

    /** Get a single available product by slug */
    public function product(string $slug);
}
