<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionTimeout
{
    protected $timeout = 3600; // 1 hour in seconds

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = Session::get('lastActivityTime');
            $currentTime = now()->timestamp;

            if ($lastActivity && ($currentTime - $lastActivity) > $this->timeout) {
                Auth::logout();
                Session::flush(); // or Session::invalidate()
                return redirect()->route('login')->with('message', 'You have been logged out due to inactivity.');
            }

            Session::put('lastActivityTime', $currentTime);
        }

        return $next($request);
    }
}
