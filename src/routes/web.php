<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use Illuminate\Support\Facades\Auth;

Auth::routes([
    'register'  => false,
    'reset'     => false,
    'confirm'   => false,
    'verify'    => false,
]);

LA09R\StarterKit\UI\Vue\Inertia\App\Router::webRoutes();
