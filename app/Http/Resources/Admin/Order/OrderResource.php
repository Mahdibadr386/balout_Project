<?php

namespace App\Http\Resources\Admin\Order;

use App\Http\Resources\Auth\UserAddressResource;
use App\Http\Resources\Public\Branch\BranchResource;
use App\Models\Branch;
use App\Models\Time;
use App\Models\UserAddress;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        $time = Time::where('id' , $this->send_hour)->first();
        $send_hour = ($time) ? 'ساعت '. $time->start . ' - ' . $time->end : $this->send_hour;

        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'branch' => $this->branch_id ? new BranchResource(Branch::find($this->branch_id)) : null,
            'address' => $this->address_id ? new UserAddressResource(UserAddress::find($this->address_id)) : null,
            'subtotal' => $this->subtotal,
            'discount' => $this->discount,
            'shipping_cost' => $this->shipping_cost,
            'send_date' => $this->send_date,
            'send_hour' => $send_hour,
            'tax' => $this->tax,
            'total' => $this->total,
            'payment_method' => $this->payment_method,
            'currency' => $this->currency,
            'meta' => $this->meta,
            'created_at' => Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s'),
            'updated_at' => Jalalian::fromCarbon($this->updated_at)->format('Y/m/d H:i:s'),
            'items' => OrderItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
