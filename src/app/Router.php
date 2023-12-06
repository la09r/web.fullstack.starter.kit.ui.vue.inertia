<?php

namespace LA09R\StarterKit\UI\Vue\Inertia\App;

use Illuminate\Support\Facades\Route;
use LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers\Auth\LoginController;
use LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers\PublicController;
use LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers\DashboardController;
use LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers\NavController;

use LA09R\StarterKit\UI\Vue\Inertia\App\Providers\RouteServiceProvider;

class Router
{
    public static function apiRoutes()
    {
        Route::post(RouteServiceProvider::BACK . '/nav/logout', [ LoginController::class, 'logout' ])->name('main.' . RouteServiceProvider::PREFIX_API . '.logout');
        Route::get(RouteServiceProvider::BACK . '/nav/select', [ NavController::class, 'apiSelect' ])->name('main.' . RouteServiceProvider::PREFIX_API . '.nav.select');
    }

    public static function webRoutes()
    {
        Route::get(RouteServiceProvider::HOME_PUBLIC, [ PublicController::class, 'index' ])->name('main.' . RouteServiceProvider::PREFIX_WEB . '.public');

        Route::middleware(['auth'])->group(function () {
            Route::get(RouteServiceProvider::HOME, [ DashboardController::class, 'index' ])->name('main.' . RouteServiceProvider::PREFIX_WEB . '.dashboard');
        });
    }
}