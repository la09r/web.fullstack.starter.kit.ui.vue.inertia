<?php

namespace LA09R\StarterKit\UI\Vue\Inertia\App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/starter_kit_ui_vue_inertia.php'                  => config_path('starter_kit_ui_vue_inertia.php'),
            __DIR__ . '/../../routes/web.php'                                         => base_path('routes/web.php'),

            __DIR__ . '/../../app/Http/Controllers/Auth/ForgotPasswordController.php' => app_path('Http/Controllers/Auth/ForgotPasswordController.php'),
            __DIR__ . '/../../app/Http/Controllers/Auth/RegisterController.php'       => app_path('Http/Controllers/Auth/RegisterController.php'),
            __DIR__ . '/../../app/Http/Controllers/Auth/ResetPasswordController.php'  => app_path('Http/Controllers/Auth/ResetPasswordController.php'),

            __DIR__ . '/../../app/Http/Middleware/HandleInertiaRequests.php'          => app_path('Http/Middleware/HandleInertiaRequests.php'),
            __DIR__ . '/../../app/Http/Kernel.php'                                    => app_path('Http/Kernel.php'),

            __DIR__ . '/../../app/Providers/RouteServiceProvider.php'                 => app_path('Providers/RouteServiceProvider.php'),

            __DIR__ . '/../../resources/js/Layouts/CardLayout.vue'                    => resource_path('js/Layouts/CardLayout.vue'),
            __DIR__ . '/../../resources/js/Pages/Error/Index.vue'                     => resource_path('js/Pages/Error/Index.vue'),
            __DIR__ . '/../../resources/js/Pages/Public/Index.vue'                    => resource_path('js/Pages/Public/Index.vue'),
            __DIR__ . '/../../resources/js/Pages/Dashboard/Index.vue'                 => resource_path('js/Pages/Dashboard/Index.vue'),

            __DIR__ . '/../../resources/js/app.js'                                    => resource_path('js/app.js'),
            __DIR__ . '/../../vite.config.js'                                         => base_path('vite.config.js'),

            __DIR__ . '/../../resources/views/auth/nav/dashboard.blade.php'           => resource_path('views/auth/nav/dashboard.blade.php'),
            __DIR__ . '/../../resources/views/auth/nav/public.blade.php'              => resource_path('views/auth/nav/public.blade.php'),
            __DIR__ . '/../../resources/views/auth/passwords/confirm.blade.php'       => resource_path('views/auth/passwords/confirm.blade.php'),
            __DIR__ . '/../../resources/views/auth/passwords/email.blade.php'         => resource_path('views/auth/passwords/email.blade.php'),
            __DIR__ . '/../../resources/views/auth/passwords/reset.blade.php'         => resource_path('views/auth/passwords/reset.blade.php'),
            __DIR__ . '/../../resources/views/auth/login.blade.php'                   => resource_path('views/auth/login.blade.php'),
            __DIR__ . '/../../resources/views/auth/register.blade.php'                => resource_path('views/auth/register.blade.php'),
            __DIR__ . '/../../resources/views/auth/verify.blade.php'                  => resource_path('views/auth/verify.blade.php'),
            __DIR__ . '/../../resources/views/layouts/auth.blade.php'                 => resource_path('views/layouts/auth.blade.php'),
            __DIR__ . '/../../resources/views/layouts/dashboard.blade.php'            => resource_path('views/layouts/dashboard.blade.php'),
            __DIR__ . '/../../resources/views/layouts/error.blade.php'                => resource_path('views/layouts/error.blade.php'),
            __DIR__ . '/../../resources/views/layouts/public.blade.php'               => resource_path('views/layouts/public.blade.php'),
            __DIR__ . '/../../resources/views/auth.blade.php'                         => resource_path('views/auth.blade.php'),
            __DIR__ . '/../../resources/views/dashboard.blade.php'                    => resource_path('views/dashboard.blade.php'),
            __DIR__ . '/../../resources/views/error.blade.php'                        => resource_path('views/error.blade.php'),
            __DIR__ . '/../../resources/views/public.blade.php'                       => resource_path('views/public.blade.php'),
        ]);

           $usersCount = \App\Models\User::all()->count();
        if($usersCount == 0)
        {
            print PHP_EOL;
            print '  Create user..' . PHP_EOL . PHP_EOL;

            $user =       \App\Models\User::factory()->create();

            print '  User Email Address: ' . $user->email . PHP_EOL;
            print '  User Password:      ' . 'password' . PHP_EOL;
        }
    }
}
