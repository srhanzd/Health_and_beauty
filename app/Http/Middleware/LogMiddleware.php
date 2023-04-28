<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

class LogMiddleware
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
//        return $next($request);
        try {
            $response = $next($request);//->this is the response
            if (app()->environment('local')) {
                if (Auth::user()) {


                    $log = [
                        'URI' => $request->getUri(),
                        'METHOD' => $request->getMethod(),
                        'REQUEST_BODY' => $request->all(),
                        'RESPONSE' => $response->getContent(),
                        'IP'=>$request->ip(),
                        'USER_ID' => Auth::user()->id,
                        'USER_NAME' => Auth::user()->name,
                    ];
                } else {
                    $log = [
                        'URI' => $request->getUri(),
                        'METHOD' => $request->getMethod(),
                        'REQUEST_BODY' => $request->all(),
                        'RESPONSE' => $response->getContent(),
                        'IP'=>$request->ip(),
                    ];
                }
                Log::build([
                    'driver' => 'daily',
                    'path' => storage_path('logs/all_system_logs.log'),
                ])->info(json_encode($log));
            }
            return $response;
        }
        catch (Exception $exception){
            return $this->returnError($exception->getCode(),$exception->getMessage());
        }
    }
}
