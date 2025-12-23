<?php
namespace App\Http\Resources\Public\Order;

use App\Http\Resources\Auth\UserAddressResource;
use App\Http\Resources\Public\Branch\BranchResource;
use App\Models\Branch;
use App\Models\Option;
use App\Models\OptionDetail;
use App\Models\OptionMessage;
use App\Models\Time;
use App\Models\UserAddress;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {


        $time = Time::where('id' , $this->send_hour)->first();
        $send_hour = ($time) ? 'ساعت '. $time->start . ' - ' . $time->end : $this->send_hour;
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'branch' => $this->branch_id ? new BranchResource(Branch::find($this->branch_id)) : null,
            'address' => $this->address_id ? new UserAddressResource(UserAddress::find($this->address_id)) : null,
            'status' => $this->status,
            'subtotal' => $this->subtotal,
            'discount' => $this->discount,
            'shipping_cost' => $this->shipping_cost,
            'tax' => $this->tax,
            'total' => $this->total,
            'send_date' => $this->send_date,
            'send_hour' => $send_hour,
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
        ];
    }
}
