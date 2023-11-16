#!/usr/bin/bash
# set .env

php artisan migrate

composer require la09r/web-fullstack-starter-kit-ui-vue-inertia:10.0.1

php artisan vendor:publish --provider="LA09R\StarterKit\UI\Vue\Inertia\App\Providers\AppServiceProvider" --force

git add . && git commit -m 'publish package'

# php artisan tinker
# User::factory()->create()
# login = email field from tinker output, password = password




