<?php

namespace App\Events;

use App\Traits\GeneralTrait;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Notification;

class NewReservation //implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels,GeneralTrait;
    public $resrvation;
    public $notification;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($resrvation)
    {
        $this->resrvation=$resrvation;
        $this->notification = new Notification();
        $this->notification->Title = 'New Reservation';
        $this->notification->Data = 'A new reservation has been made: ' . "\n" .
            'Day: ' . $this->resrvation['Date'] . "\n" .
            'Time: ' . $this->resrvation['Time'];
//        $notification->FromUserId = auth()->user()->id; // Assuming you have authenticated users
        $this->notification->ToUserId = $this->resrvation['user_id'];
        $this->notification->save();
        $this->fire_base_push_notification($this->resrvation['Notification_token'],
            'New Reservation',
            'A new reservation has been made: ' . "\n" .
            'Day: ' . $this->resrvation['Date'] . "\n" .
            'Time: ' . $this->resrvation['Time']);
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
//           // 'resrvation'=>$this->resrvation
//        ];
//    }

//    /**
//     * Get the channels the event should broadcast on.
//     *
//     * @return \Illuminate\Broadcasting\Channel|array
//     */
//    public function broadcastOn()
//    {
//        // dd($this->resrvation['user_id']);
////        return new PrivateChannel('reservation_reminder.'.$this->resrvation['user_id']);
//      //  return new PrivateChannel('user.'.$this->resrvation['user_id']);
//    }

}
