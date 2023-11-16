<?php

namespace LA09R\StarterKit\UI\Vue\Inertia\App;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers\PublicController;
use LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers\DashboardController;

class Router
{
    public static function routes()
    {
        Route::get('/', [ PublicController::class, 'index' ])
            ->name('route.public');

        Route::get('/dashboard', [ DashboardController::class, 'index' ])->middleware('auth')
            ->name('route.dashboard');

        Route::get('/dashboard/welcome', [ DashboardController::class, 'welcome' ])->middleware('auth')
            ->name('route.dashboard.welcome');
    }
}