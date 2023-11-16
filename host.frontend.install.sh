#!/bin/zsh
# exec on Host machine

npm install

# https://inertiajs.com/client-side-setup
npm install @inertiajs/vue3@1.0.14

# update npm scripts like this:
# "scripts": { "dev": "vite build --watch",

# set Homestead IP in vite.config.js:  defineConfig({ server: { host: 'Your_Homestead_IP'
# git add . && git commit -m 'init npm'

# npm run build
