<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use App\Article;
use Auth;
use Redirect;
use App\User;
use IsAdmin;

class CanOperation
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
        if (!(Auth::user()->is_admin or Auth::id() == Article::find(Route::input('id'))->user_id))
        {
            return Redirect::to('/');
        }
      return $next($request);
    }
}

