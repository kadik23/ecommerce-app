<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class newPanier implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $product_name;
    public $admin;
    public $product_price;
    public $user;
    public $img;
    public $id;
    public function __construct($data)
    {
        $this->product_name=$data['name'];
        $this->admin=$data['createdBy'];
        $this->product_price=$data['price'];
        $this->user=$data['user'];
        $this->id=$data['id'];
        $this->img=$data['img'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // return [
        //     new PrivateChannel('user.' . $this->user)
        // ];
        return ['user.' . $this->user];
        // return new PrivateChannel('user.' . $this->user);


    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}
