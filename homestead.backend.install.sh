#!/usr/bin/bash
# exec into Homestead

# set .env

rm -f ./README.md

git init && git add . && git commit -m 'init'

# https://packagist.org/packages/laravel/ui
composer require laravel/ui:4.2.2

# https://github.com/laravel/ui#installation
php artisan ui vue
php artisan ui vue --auth

git add . && git commit -m 'init ui vue'


#https://inertiajs.com/server-side-setup
composer require inertiajs/inertia-laravel:0.6.11
composer require tightenco/ziggy:1.8.1

php artisan inertia:middleware

git add . && git commit -m 'init inertia & ziggy'

php artisan migrate

composer require la09r/web-fullstack-starter-kit-ui-vue-inertia:10.1.8

cp -R ./vendor/la09r/web-fullstack-starter-kit-ui-vue-inertia/src/app/Console/Commands ./app/Console

php artisan app:publish-skluvi

rm -rf ./app/Console/Commands/PublishSkluvi.php

git add . && git commit -m 'publish package'


