<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationOrderToStore implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $order;
    public $store;

    public function __construct($order,$store)
    {
        $this->order = $order;
        $this->store = $store;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('my-channel_'.$this->store);
    }

    public function broadcastAs()
    {
        return 'New-order';
    }

    public function broadcastWith(){
        return [
            'relation' => $this->order->products,
        ];
    }
}
