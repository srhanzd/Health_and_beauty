<?php

namespace App\Services\NotificationService;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class GetNotificationsService
{
    use GeneralTrait;
    public function Notifications(Request $request)
    {

        try {


            $user=auth()->user();


            $Notifications=$user->notifications()
                ->where('IsDeleted','=',0)
                ->latest()
                ->paginate(7);
            return $this->returnData('Notifications',$Notifications
                , 'Notifications retrieved successfully.', $request->header('lang'));

        } catch
        (\Exception $e) {

            return $this->returnError($e->getLine(), $e->getMessage(), $request->header('lang'));

        }
    }
}
