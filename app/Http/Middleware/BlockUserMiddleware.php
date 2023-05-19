<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class BlockUserMiddleware
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {

            $user=User::query()
                ->where('name','=',$request->only('name'))
                ->first();
            if($user!=null) {
                $blocked_date = $user->blocked_date;
                if ($blocked_date != null && !$blocked_date->isPast()) {
                    $blocked_Minutes = now()->diffInMinutes($blocked_date);
                    $message = 'Your account has been blocked. It will be unblocked after ' . $blocked_Minutes . ' ' . 'Minutes';
                    return $this->returnError(888, $message,$request->header('lang'));
                }
            }
            return $next($request);

        }
        catch (\Exception $exception){
            return $this->returnError($exception->getCode(),$exception->getMessage(),$request->header('lang'));
        }
    }
}
