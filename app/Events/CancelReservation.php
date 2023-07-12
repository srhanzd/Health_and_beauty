<?php

namespace App\Events;

use App\Traits\GeneralTrait;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Notification;

class CancelReservation //implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels,GeneralTrait;

    public $reservation;
    public $notification;

    /**
     * Create a new event instance.
     *
     * @param  array  $reservation
     * @return void
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
        $this->notification = new Notification();
        $this->notification->Title = 'Reservation Canceled';
        $this->notification->Data = 'Your reservation has been canceled.' . "\n" .
            'Day: ' . $this->reservation['Date'] . "\n" .
            'Time: ' . $this->reservation['Time'];
        $this->notification->ToUserId = $this->reservation['user_id'];
        $this->notification->save();
        $this->fire_base_push_notification($this->reservation['Notification_token'],
            'Reservation Canceled',
            'Your reservation has been canceled.' . "\n" .
            'Day: ' . $this->reservation['Date'] . "\n" .
            'Time: ' . $this->reservation['Time']);
    }

//    /**
//     * Get the data to broadcast.
//     *
//     * @return array
//     */
//    public function broadcastWith()
//    {
//        return [
//            'notification' => $this->notification,
//        ];
//    }
//
//    /**
//     * Get the channels the event should broadcast on.
//     *
//     * @return \Illuminate\Broadcasting\Channel|array
//     */
//    public function broadcastOn()
//    {
//        return new PrivateChannel('user.'.$this->reservation['user_id']);
//    }
}
