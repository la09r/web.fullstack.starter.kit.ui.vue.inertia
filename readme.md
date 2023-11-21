# Manual

## Requirements

1. **Homestead** virtual machine:
  - installed and configured for cli: PHP v. 8.1, Composer, Git
1. **Host** machine:
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
  - in `app/Http/Kernel.php` add to `protected $middleware array`:
    ```
    \LA09R\StarterKit\UI\Vue\Inertia\App\Http\Middleware\HandleInertiaRequests::class,
    ```
    in `config/app.php` add to `providers`:
    ```
    LA09R\StarterKit\UI\Vue\Inertia\App\Providers\RouteServiceProvider::class,
    ```
    in `config/app.php` add to `aliases`:
    ```
    App\Providers\RouteServiceProvider::class => LA09R\StarterKit\UI\Vue\Inertia\App\Providers\RouteServiceProvider::class
    ```
  - `php artisan tinker`
  - `User::factory()->create()`, save: **login** = `email` field from tinker output, **password** = `password`

1. on **Host** machine:
  - copy **host.frontend..sh** files to `DOCUMENT_ROOT`
  - update **+x** permission for ***.sh** files,
  - replace `#!/bin/zsh` from **host.frontend..sh** files to you **bash** bin path
  - exec `host.frontend.install.sh` on **Host** machine
  - in `package.json` set `vite build --watch` for `script.dev` section
  - in `vite.config.js` set `Your_Homestead_IP ` for `defineConfig.server.host` section
  - `npm run dev` and checkout browser `APP_URL `