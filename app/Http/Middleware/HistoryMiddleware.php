<?php

namespace App\Http\Middleware;

use App\Models\History;
use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

class HistoryMiddleware
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
            $response = $next($request);//->this is the response
            if (app()->environment('local')) {
                if (Auth::user()) {
             History::query()->create([
                 'UserId'=>Auth::user()->id,
                 'ApiUrl'=>$request->getPathInfo(),
                 'IP'=>$request->ip(),
                 'Date'=>now()
             ]);


                }

            }
            return $response;
        }
        catch (Exception $exception){
            return $this->returnError($exception->getCode(),$exception->getMessage(),$request->header('lang'));
        }
    }
}
