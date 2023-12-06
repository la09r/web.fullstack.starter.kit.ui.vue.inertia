<?php

namespace LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers;

use LA09R\StarterKit\UI\Vue\Inertia\App\Console\Builders\DashboardMenuBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use LA09R\StarterKit\UI\Vue\Inertia\App\Providers\RouteServiceProvider;

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
                'url'  => url(RouteServiceProvider::HOME_PUBLIC),
                'support' => __('Toggle navigation'),
                'token' => [
                    'csrf' => $tokenCsrf
                ],
                'auth' => Auth::check(),
            ],
            'menu' => [
                'guest' => [
                    'login' => [
                        'condition' => $routePath !== RouteServiceProvider::LOGIN,
                        'title' => __('Login'),
                        'link'  => route('login'),
                    ],
                    'public' => [
                        'condition' => $routePath === RouteServiceProvider::LOGIN,
                        'title' => __('Public'),
                        'link'  => route('main.' . RouteServiceProvider::PREFIX_WEB . '.public'),
                    ],
                ],
                'user' => [
                        'public' => [
                            'condition' => strpos($routePath, 'dashboard'),
                            'title' => __('Public'),
                            'link'  => route('main.' . RouteServiceProvider::PREFIX_WEB . '.public'),
                        ],
                    'dashboard' => [
                        'index' => [
                            'condition' => !strpos($routePath, str_replace('/', '', RouteServiceProvider::HOME)) || $routePath !== RouteServiceProvider::HOME,
                            'title' => __('Dashboard'),
                            'link'  => route('main.' . RouteServiceProvider::PREFIX_WEB . '.dashboard'),
                        ],

                        'logout' => [
                            'title' => __('Logout'),
                            'link'  => route('logout'),
                        ],

                        'info' => [
                            'name' => Auth::user()->name ?? __('Guest'),
                        ],

                        'menu' => [
                            'condition' => strpos($routePath, str_replace('/', '', RouteServiceProvider::HOME)),
                            'items' => [],
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

        return $request->wantsJson() ? new JsonResponse($data, 200) : redirect(RouteServiceProvider::LOGIN);
    }
}