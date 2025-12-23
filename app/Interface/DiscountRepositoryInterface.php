<?php

namespace App\Interface;

use App\Models\Cart;
use App\Models\Discount;
use App\Models\DiscountCode;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

interface DiscountRepositoryInterface
{
    /**
     * Paginate discounts with optional filters.
     */
    public function paginate(array $filters = []);

    /**
     * Store a new discount in database.
     */
    public function store(array $data);

    /**
     * Find a discount by its ID.
     */
    public function find(int $id);

    /**
     * Update an existing discount by ID.
     */
    public function update(int $id, array $data);

    /**
     * Create a discount code for a discount.
     */
    public function createCode(int $discountId, array $data);

    /**
     * Paginate discount usages with optional filters.
     */
    public function usages(array $filters = []);

    /**
     * Retrieve all active discounts that can be applied to a given product
     * for a specific user.
     */
    public function getActiveForProduct(Product $product, User $user);

    /**
     * Find and validate a discount code entered by the user.
    */
    public function findValidCode(string $code): DiscountCode;

    /**
     * Generate a new human-readable discount code.
    */
    public function generateCode();

    /**
     * Delete a discount with codes
     */
    public function delete(Discount $discount);
}
