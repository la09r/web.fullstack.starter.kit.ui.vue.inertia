# Manual

This is main package. All npm packages for UI install here.

## Requirements

1. **Homestead** virtual machine:
  - installed and configured for cli: PHP v. 8.1, Composer, Git
2. **Host** machine:
  - installed and configured for cli: Node(JavaScript runtime environment) v. 18

## Install

1. into **Homestead** virtual machine:
  - change directory to `DOCUMENT_ROOT `: `cd /home/vagrant/code/81/home/test/http/laravel/d`
  - `rm -rf ./* && rm -rf ./.git && rm -rf ./.idea && rm -f ./.g* && rm -f ./.e* && rm -f ./.D*`
  - `composer create-project laravel/laravel . "10.2.9"`
  - in `.env` set:
    ```
    APP_URL=http://d.laravel.test.home.81.local
	
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=d_laravel_test_home_81
    DB_USERNAME=homestead
    DB_PASSWORD=secret
    ```
  - create `DB_DATABASE` or drop all exist tables in `DB_DATABASE`
  - copy **homestead.backend..sh** files to `DOCUMENT_ROOT`
  - update **+x** permission for ***.sh** files,
  - exec `homestead.backend.install.sh`
  - in `config/app.php` in `aliases`:
    ```php
    // add:
    App\Http\Controllers\Auth\LoginController::class => LA09R\StarterKit\UI\Vue\Inertia\App\Http\Controllers\Auth\LoginController::class,
    App\Providers\RouteServiceProvider::class        => LA09R\StarterKit\UI\Vue\Inertia\App\Providers\RouteServiceProvider::class
    ```
  - in `config/app.php` in `providers`:
    ```php
    // add:
    LA09R\StarterKit\UI\Vue\Inertia\App\Providers\AppServiceProvider::class,
    LA09R\StarterKit\UI\Vue\Inertia\App\Providers\RouteServiceProvider::class,
    ```
  - in `app/Http/Kernel.php` in `protected $middleware array`:
    ```php
    // add:
    \LA09R\StarterKit\UI\Vue\Inertia\App\Http\Middleware\HandleInertiaRequests::class,
    ```
  - in `app/Http/Kernel.php`uncomment
    ```php
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    ```
  - in `config/view.php` in `paths` delete all and:
    ```php
    base_path('vendor/la09r/web-fullstack-starter-kit-ui-vue-inertia/src/resources/views'),
    ```
  - add in `composer.json` in `autoload`:
    ```json
    "files": [
        ".env.php"
    ]
    ```
  - in bash:
    ```bash
    php artisan tinker
    ```
    ```php
    User::factory()->create() // save: login = `email` field from tinker output, password = `password`
    ```

2. in **Host** machine:
  - copy **host.frontend..sh** files to `DOCUMENT_ROOT`
  - update **+x** permission for ***.sh** files,
  - replace `#!/bin/zsh` from **host.frontend..sh** files to you **bash** bin path
  - exec `host.frontend.install.sh` on **Host** machine
  - in `package.json` set `vite build --watch` for `script.dev` section
  - in `vite.config.js` set `Your_Homestead_IP ` for `defineConfig.server.host` section
  - `npm run dev` and checkout browser `APP_URL `