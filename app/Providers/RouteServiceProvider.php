<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    public const ADMIN_HOME = '/admin/dashboard';

    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware(['web'])
                ->namespace($this->namespace)
                ->group(function () {
                    $this->loadAdminRoutes();
                });
        });
    }

    protected function loadAdminRoutes()
    {
        Route::group([
            'namespace' => 'Admin',
        ], function () {
            Route::get('/', 'DashboardController@base');
            Auth::routes(['register' => true]);
            Route::group(['middleware' => ['admin.auth']], function () {
                $this->requireRouteFiles('admin');
            });
        });
    }

    protected function requireRouteFiles($path): void
    {
        $routeFiles = File::allFiles(base_path('routes/' . $path));
        foreach ($routeFiles as $file) {
            require_once $file->getRealPath();
        }
    }
}
