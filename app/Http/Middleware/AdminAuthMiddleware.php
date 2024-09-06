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
        if (Auth::user() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('artist_manager') || Auth::user()->hasRole('artist'))) {
            $routeName = Route::currentRouteName();
            if (!Auth::user()->hasPermission($routeName)) {
                if ($request->ajax()) {
                    $data['title']   = "Auth Error";
                    $data['message'] = 'Permission denied!';
                    $data['data']    = $routeName;
                    return response($data, 403);
                }
                abort(403);
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
