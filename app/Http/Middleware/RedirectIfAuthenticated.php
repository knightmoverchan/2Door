<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->user_type=='Admin' )
        {
            return redirect('/adminHome');
        }
        elseif ( Auth::check() && Auth::user()->user_type=='User' )
        {
            return redirect('/senderHome');
        }
        elseif ( Auth::check() && Auth::user()->user_type=='Messenger' )
        {
            return redirect('/messengerHome');
        }
        elseif ( Auth::check() && Auth::user()->user_type=='Cashier' )
        {
            return redirect('/cashierhome');
        }

        return $next($request);
    }
}
