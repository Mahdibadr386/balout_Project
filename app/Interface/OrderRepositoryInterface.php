<?php

namespace App\Interface;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemOption;

interface OrderRepositoryInterface
{
    /** Paginate all orders with items and options */
    public function paginate(array $filters = []);

    /** Find an order by ID with items and options */
    public function find($id);

    /** Create a new order with items and options */
    public function store(array $data): Order;

    /** Delete an order by ID along with items and options */
    public function delete($id);

    /** Update order status by ID */
    public function updateStatus($id, $status);

    /** Create an order item option */
    public function OrderItemOptionCreate(array $data): OrderItemOption;

    /** Create an order item */
    public function OrderItemCreate(array $data): OrderItem;

    /** Create an order */
    public function OrderCreate(array $data): Order;

    /** Find an order with items and payments */
    public function OrderFindWithItems(int $id): ?Order;

    /** Update the status of an order */
    public function OrderUpdateStatus(Order $order, string $status): bool;

    /**
     * Retrieve an order with all related items and pricing data required for calculations.
     */
    public function findWithItemsForPricing(int $orderId): Order;

    /**
     * Update order monetary totals after applying discounts and recalculating pricing.
     */
    public function updateTotals(
        Order $order,
        float $subtotal,
        float $discount,
        float $total
    ): void;

}
