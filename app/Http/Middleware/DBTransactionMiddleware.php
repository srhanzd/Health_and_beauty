<?php

namespace App\Http\Middleware;

use Closure;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DBTransactionMiddleware
{ /**
 * Handle an incoming request.
 *
 * @param  \Illuminate\Http\Request $request
 * @param  \Closure                 $next
 *
 * @return mixed
 * @throws \Exception
 */
    public function handle($request, Closure $next)
    {
        DB::beginTransaction();

        try {
            $response = $next($request);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        if ( $response->getData()->status==false) {
            DB::rollBack();
        } else {
            DB::commit();
        }

        return $response;
    }
}
