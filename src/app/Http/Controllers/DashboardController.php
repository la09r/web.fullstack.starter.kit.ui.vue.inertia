<?php

namespace LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Dashboard/Index', [
            'text' => 'Test Dashboard/Index',
        ]);
    }

    public function welcome(Request $request)
    {
        return Inertia::render('Welcome/Index', [
            'app_version' => \Illuminate\Foundation\Application::VERSION,
            'php_version' => PHP_VERSION,
        ]);
    }
}