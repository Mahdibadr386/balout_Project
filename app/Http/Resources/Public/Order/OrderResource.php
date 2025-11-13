<?php
namespace App\Http\Resources\Public\Order;

use App\Models\Option;
use App\Models\OptionDetail;
use App\Models\OptionMessage;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'status' => $this->status,
            'subtotal' => $this->subtotal,
            'discount' => $this->discount,
            'shipping_cost' => $this->shipping_cost,
            'tax' => $this->tax,
            'total' => $this->total,
            'items' => $this->items->map(fn($i) => [
                'id' => $i->id,
                'product' => $i->product_snapshot,
                'quantity' => $i->quantity,
                'unit_price' => $i->unit_price,
                'options' => $i->options->map(fn($o)=> [
                    'option_name'=>Option::find($o->option_id)->name,
                    'option_detail_name' => optional(OptionDetail::find($o->option_detail_id))->name,
                    'option_message_text' => optional(OptionMessage::find($o->message))->text,
                    'price_effect'=>$o->price_effect,
                ]),
            ]),
            'payments' => $this->payments,
            'created_at' => $this->created_at,
        ];
    }
}
