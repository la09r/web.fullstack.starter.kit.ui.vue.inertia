<?php

namespace LA09R\StarterKit\UI\Vue\Inertia\App\Http\Middleware;

use LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'dashboard'; // app.blade.php => admin.blade.php

    public function rootView(Request $request)
    {
        return strpos($request->getPathInfo(), $this->rootView) !== false ? $this->rootView : 'public';
    }

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        // updated code
        return array_merge(parent::share($request), [
            'user' => function () use ($request) {
                try
                {
                    $tokenBearer = $request->session()->get('auth.token_bearer');
                    $tokenCsrf   = $request->session()->get('_token');
                }
                catch (\Exception | \Error $e)
                {
                    $tokenBearer = '';
                    $tokenCsrf   = '';
                }

                return [
                    'user_id' => Auth::user()->id ?? 0,
                    'auth'    => Auth::check(),
                    'token' => [
                        LoginController::SANCTUM_BEARER_TOKEN_KEY => $tokenBearer, // bearer token already exist in <div id="app" data-page="
                        'csrf' => $tokenCsrf,
                    ],
                ];
            },
        ]);
        // updated code
    }
}
