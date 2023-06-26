<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewReservation implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $resrvation;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($resrvation)
    {
        $this->resrvation=$resrvation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // dd($this->resrvation['user_id']);
        return new PrivateChannel('reservation_reminder.'.$this->resrvation['user_id']);
    }

}
