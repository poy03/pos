<?php

namespace App\Http\Middleware;

use Closure;
use DB;
class LoggedRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_data = DB::table("tbl_users")->where("accountID",$request->session()->get('user'))->where("deleted",0);
        /*
        if (!$request->session()->has('user')||$user_data->count()==0) {
            return response('', 403);
        }
        */
        return $next($request);
    }
}
