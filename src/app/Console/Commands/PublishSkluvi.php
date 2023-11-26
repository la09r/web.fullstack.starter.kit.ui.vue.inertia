<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;

class PublishSkluvi extends PublishFiles
{
    private const PATH_FROM = 'vendor/la09r/web-fullstack-starter-kit-ui-vue-inertia/src';
    
    private const FILES_REMOVE = [
        'js/components/ExampleComponent.vue',
    ];

    private const FILES_COPY = [
        'resources/js/app.js.php'                    => 'js/app.js',
        'resources/js/packages.js.php'               => 'js/packages.js',
        'resources/js/constant.js.php'               => 'js/constant.js',
        
        'resources/php/menu/Dashboard/main.php'      => 'php/menu/Dashboard/main.php',

        'resources/js/Components/Dashboard/Nav.vue'  => 'js/Components/Dashboard/Nav.vue',
        
        'resources/js/ComponentsAsync/Dashboard/Widget/MainInfo.vue' => 'js/ComponentsAsync/Dashboard/Widget/MainInfo.vue',
        'resources/js/ComponentsAsync/Dashboard/Widget/MainStat.vue' => 'js/ComponentsAsync/Dashboard/Widget/MainStat.vue',

        '.env.php'                           => '.env.php',
        'vite.config.js.php'                 => 'vite.config.js',
        'vite.copy.componentsAsync.js.php'   => 'vite.copy.componentsAsync.js',
    ];
    
    protected $signature   = 'app:publish-skluvi';
    protected $description = 'Publish done';

    public function handle()
    {
        foreach (self::FILES_REMOVE as $file)
        {
            try
            {
                File::delete(resource_path($file));
            }
            catch (\Exception | \Error $e)
            {

            }
        }

        try
        {
            File::deleteDirectory(resource_path('views'));
            File::deleteDirectory(resource_path('js/components'));
        }
        catch (\Exception | \Error $e)
        {

        }

        $code = file_get_contents(base_path(self::PATH_FROM . '/resources/sass/app.scss'));
                file_put_contents(base_path('resources/sass/app.scss'), PHP_EOL . PHP_EOL . $code, FILE_APPEND);
                file_put_contents(base_path('.gitignore'), PHP_EOL . PHP_EOL . '.env.php', FILE_APPEND);

        $this->publishFiles(self::FILES_COPY, self::PATH_FROM);
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
