<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;

class PublishSkluvi extends PublishFiles
{
    private const PATH_FROM = 'vendor/la09r/web-fullstack-starter-kit-ui-vue-inertia/src';
    
    private const FILES = [
       'resources/js/components/Dashboard/Nav.vue'              => ('js/components/Dashboard/Nav.vue'),

       'resources/js/Layouts/CardLayout.vue'                    => ('js/Layouts/CardLayout.vue'),
       'resources/js/Pages/Error/Index.vue'                     => ('js/Pages/Error/Index.vue'),
       'resources/js/Pages/Public/Index.vue'                    => ('js/Pages/Public/Index.vue'),
       'resources/js/Pages/Dashboard/Index.vue'                 => ('js/Pages/Dashboard/Index.vue'),

       'resources/js/app.js.php'                                => ('js/app.js'),
       'vite.config.js.php'                                     => ('vite.config.js'),

       'resources/views/auth/nav/dashboard.blade.php'           => ('views/auth/nav/dashboard.blade.php'),
       'resources/views/auth/nav/public.blade.php'              => ('views/auth/nav/public.blade.php'),
       'resources/views/auth/passwords/confirm.blade.php'       => ('views/auth/passwords/confirm.blade.php'),
       'resources/views/auth/passwords/email.blade.php'         => ('views/auth/passwords/email.blade.php'),
       'resources/views/auth/passwords/reset.blade.php'         => ('views/auth/passwords/reset.blade.php'),
       'resources/views/auth/login.blade.php'                   => ('views/auth/login.blade.php'),
       'resources/views/auth/register.blade.php'                => ('views/auth/register.blade.php'),
       'resources/views/auth/verify.blade.php'                  => ('views/auth/verify.blade.php'),
       'resources/views/layouts/auth.blade.php'                 => ('views/layouts/auth.blade.php'),
       'resources/views/layouts/dashboard.blade.php'            => ('views/layouts/dashboard.blade.php'),
       'resources/views/layouts/error.blade.php'                => ('views/layouts/error.blade.php'),
       'resources/views/layouts/public.blade.php'               => ('views/layouts/public.blade.php'),
       'resources/views/auth.blade.php'                         => ('views/auth.blade.php'),
       'resources/views/dashboard.blade.php'                    => ('views/dashboard.blade.php'),
       'resources/views/error.blade.php'                        => ('views/error.blade.php'),
       'resources/views/public.blade.php'                       => ('views/public.blade.php'),
    ];
    
    protected $signature   = 'app:publish-skluvi';
    protected $description = 'Publish done';

    public function handle()
    {
        try
        {
            File::delete(resource_path('js/components/ExampleComponent.vue'));

            File::delete(resource_path('views/layouts/app.blade.php'));
            File::delete(resource_path('views/welcome.blade.php'));
            File::delete(resource_path('views/home.blade.php'));
        }
        catch (\Exception | \Error $e)
        {

        }

        file_put_contents(base_path('resources/sass/app.scss'), PHP_EOL . '.icon-svg-size-24 { width: 24px; }', FILE_APPEND);

        $this->publishFiles(self::FILES, self::PATH_FROM);
        $this->publishUsers();

        print PHP_EOL . $this->description . PHP_EOL;
    }
    
    private function publishUsers()
    {
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
