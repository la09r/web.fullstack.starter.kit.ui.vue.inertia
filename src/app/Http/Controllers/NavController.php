<?php

namespace LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers;

use LA09R\StarterKit\UI\Vue\Inertia\App\Console\Builders\DashboardMenuBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class NavController extends Controller
{
    public function apiSelect(Request $request)
    {
        $routePath = $request->pathname;

        try
        {
            $tokenCsrf = $request->session()->get('_token');
        }
        catch (\Exception | \Error $e)
        {
            $tokenCsrf = '';
        }

        $data = [
            'app' => [
                'name' => config('app.name', 'Laravel'),
                'url'  => url('/'),
                'support' => __('Toggle navigation'),
                'token' => [
                    'csrf' => $tokenCsrf
                ],
                'auth' => Auth::check(),
            ],
            'menu' => [
                'guest' => [
                    'login' => [
                        'condition' => Route::has('login') && $routePath !== '/login',
                        'title' => __('Login'),
                        'link'  => route('login'),
                    ],
                    'public' => [
                        'condition' => Route::has('login') && $routePath === '/login',
                        'title' => __('Public'),
                        'link'  => route('route.public'),
                    ],
                ],
                'user' => [
                        'public' => [
                            'condition' => strpos($routePath, 'dashboard'),
                            'title' => __('Public'),
                            'link'  => route('route.public'),
                        ],
                    'dashboard' => [
                        'index' => [
                            'condition' => !strpos($routePath, 'dashboard') || $routePath !== '/dashboard',
                            'title' => __('Dashboard'),
                            'link'  => route('route.dashboard'),
                        ],

                        'logout' => [
                            'title' => __('Logout'),
                            'link'  => route('logout'),
                        ],

                        'info' => [
                            'name' => Auth::user()->name ?? __('Guest'),
                        ],

                        'menu' => [
                            'condition' => strpos($routePath, 'dashboard'),
                            'items' => [],
//                                [
//                                [
//                                    'title' => __('Permissions'),
//                                    'link'  => route('web.route.dashboard.permission.list'),
//                                ],
//                                [
//                                    'title' => __('Roles'),
//                                    'link'  => route('web.route.dashboard.role.list'),
//                                ],
//                                [
//                                    'title' => __('Users'),
//                                    'link'  => route('web.route.dashboard.user.list'),
//                                ],
//                                [
//                                    'title' => __('Profile'),
//                                    'link'  => route('web.route.dashboard.profile.list'),
//                                ],
//                                ]
                        ]
                    ],
                ],
            ]
        ];

        $data['menu']['user']['dashboard']['menu']['items'] = DashboardMenuBuilder::build();

        if(!Auth::check())
        {
            unset($data['app']['token'], $data['menu']['user']);
        }

        return $request->wantsJson() ? new JsonResponse($data, 200) : redirect('/login');
    }
}