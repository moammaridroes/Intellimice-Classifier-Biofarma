<?php

namespace App\Events;

use App\Models\CustomerOrder;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    public function __construct(CustomerOrder $order)
    {
        $this->order = $order;
    }

    public function broadcastOn(): array
    {
        return [new Channel('orders')];
    }

    public function broadcastAs(): string
    {
        return 'order.created';
    }

    public function broadcastWith(): array
    {
        return [
            'order' => [
                'id' => $this->order->id,
                'fullname' => $this->order->fullname,
                'phone_number' => $this->order->phone_number,
                'email' => $this->order->email,
                'item_name' => $this->order->item_name,
                'agency_name' => $this->order->agency_name,
                'pick_up_date' => $this->order->pick_up_date,
                'weight' => $this->order->weight,
                'male_quantity' => $this->order->male_quantity,
                'female_quantity' => $this->order->female_quantity,
                'total_price' => $this->order->total_price,
                'notes' => $this->order->notes,
                'status' => $this->order->status,
            ]
        ];
    }
}