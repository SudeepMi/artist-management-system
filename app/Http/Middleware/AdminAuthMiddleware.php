<?php

namespace App\Http\Middleware;

use App\Models\Zone;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && (Auth::user()->role== 'admin' || Auth::user()->role = 'artist_manager' || Auth::user()->role = 'artist')) {
            $routeName = Route::currentRouteName();

            $role = Auth::user()->getOriginal('role');
            $global_roles = config('app.permissions');
          
            if (empty($global_roles[$role])) {
                abort(403);
            }else{
                $allowed_routes  = $global_roles[$role];
                if (!in_array($routeName, $allowed_routes)) {
                    abort(403);
                }
            }
            
            return $next($request);
        }
        Session::flash(
            'flash',
            [
                'type'    => 'danger',
                'message' => 'Unauthorized access attempted! Please use admin credentials to login.'
            ]
        );
        if (Auth::user()) {
            Auth::logout();
        }
        return redirect('/login');
    }
}
