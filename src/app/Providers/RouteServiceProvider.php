<?php

namespace LA09R\StarterKit\UI\Vue\Inertia\App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
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
    public const HOME         = '/dashboard';
    public const HOME_PUBLIC  = '/';

    public const LOGIN  = '/login';
    public const BACK   = '/backend';

    public const PREFIX_WEB       = 'web.route';
    public const PREFIX_WEB_HOME  = 'web.route.dashboard';

    public const PREFIX_API       = 'api.route';
    public const PREFIX_API_HOME  = 'api.route.dashboard';

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
                ->group(__DIR__ . '/../../routes/api.php');
            Route::middleware('web')
                ->group(__DIR__ . '/../../routes/web.php');
        });
    }

    // php artisan route:list --sort=name
    public static function createRoutes($routes)
    {
        foreach ($routes as $route)
        {
                   $method = $route['method'];
            Route::$method($route['url'], $route['handler'])->name($route['name']);
        }
    }

    // php artisan route:list --sort=name
    public static function createRoutesByMiddleware($routes)
    {
        foreach ($routes as $route)
        {
            foreach ($route['methods'] as $method)
            {
                foreach ($method['items'] as $item)
                {
                    $methodId = $method['id'];
                    $handler  = [ $item['handler']['controller'], $item['handler']['method'] ];

                    Route::middleware( $route['middleware'] )->group(function () use($methodId, $handler, $item) {
                        Route::$methodId($item['url'], $handler)->name($item['name']);
                    });
                }
            }
        }
    }
}
