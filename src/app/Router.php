<?php

namespace LA09R\StarterKit\UI\Vue\Inertia\App;

use Illuminate\Support\Facades\Route;
use LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers\Auth\LoginController;
use LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers\PublicController;
use LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers\DashboardController;
use LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers\NavController;

class Router
{
    public static function apiRoutes()
    {
        Route::post('/backend/nav/logout', [ LoginController::class, 'logout' ])->name('api.route.nav.logout');
        Route::get('/backend/nav/select', [ NavController::class, 'apiSelect' ])->name('api.route.nav.select');
    }

    public static function webRoutes()
    {
        Route::get('/', [ PublicController::class, 'index' ])->name('route.public');

        Route::middleware(['auth'])->group(function () {
            Route::get('/dashboard', [ DashboardController::class, 'index' ])->name('route.dashboard');
        });
    }
}