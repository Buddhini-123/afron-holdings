<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class SessionTimeout
{
    protected $timeout = 120 * 60; // 2 hours in seconds

    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $lastActivity = Session::get('lastActivityTime');
        $currentTime = Carbon::now()->timestamp;

        if ($lastActivity && ($currentTime - $lastActivity) > $this->timeout) {
            Auth::logout();
            Session::flush();
            return redirect('/login')->withErrors(['message' => 'You have been logged out due to inactivity.']);
        }

        Session::put('lastActivityTime', $currentTime);

        return $next($request);
    }
}
