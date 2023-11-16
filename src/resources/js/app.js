import './bootstrap';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

if(document.querySelector('#app'))
{
createInertiaApp({
    resolve(name) {
        let path  = '';
        let pages = '';

        switch (name)
        {
            case 'Welcome/Index':
                path  = `../../vendor/la09r/web-fullstack-starter-kit-ui-vue-inertia/src/resources/js/Pages/%PAGE_NAME%.vue`;
                pages = import.meta.glob(`../../vendor/la09r/web-fullstack-starter-kit-ui-vue-inertia/src/resources/js/Pages/**/*.vue`)
                break;
            default:
                path  = `./Pages/%PAGE_NAME%.vue`;
                pages = import.meta.glob(`./Pages/**/*.vue`);
                break;
        }

        return resolvePageComponent(path.replace('%PAGE_NAME%', name), pages);
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .mixin({ methods: { route }})
            .use(plugin)
            .mount(el)
    },
});
}