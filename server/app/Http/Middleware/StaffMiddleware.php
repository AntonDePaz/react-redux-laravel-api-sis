<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(auth()->user()->tokenCan('staff')){
                return $next($request);
            }else{
                return response()->json([
                    'message' => 'Access Denied! Not Student!'
                ],403);
            }
        }else{
            return response()->json([
                'status' => 401,
                'message' => 'Login First!'
            ]);
        }
    }
}
