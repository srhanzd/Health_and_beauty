<?php

namespace App\Http\Controllers;

use App\Services\NotificationService\GetNotificationsService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use GeneralTrait;
    private $GetNotificationsService;

    public function __construct(GetNotificationsService $GetNotificationsService)
    {
        $this->GetNotificationsService=$GetNotificationsService;


    }

    public function GetNotifications(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->GetNotificationsService->Notifications($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }

}
