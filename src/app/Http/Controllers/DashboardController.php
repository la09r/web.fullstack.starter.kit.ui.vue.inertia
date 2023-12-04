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
}