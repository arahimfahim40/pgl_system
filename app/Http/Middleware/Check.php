<?php

namespace App\Http\Middleware;

use Closure;
use User;

class Check
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permission)
    {
        $user = auth()->guard('admin')->user();

        if (auth()->guard('admin')->check() && $user->hasPermission(['Admin',$permission]))
        {
            return $next($request);
        }

        return redirect('/');
    }
}
