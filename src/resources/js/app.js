import './bootstrap';
import packages from './packages';

import { createApp, h } from 'vue';
import { createStore } from 'vuex'

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import ConfirmationService from 'primevue/confirmationservice';
import DialogService from 'primevue/dialogservice';

import 'primevue/resources/themes/bootstrap4-light-blue/theme.css'
import 'primeicons/primeicons.css'

import Nav from '@/Components/Dashboard/Nav.vue';
import AuthServices from '@/Components/Dashboard/AuthServices.vue';

function getPackageData(name)
{
    const DATA_DEFAULT = {
        path: `./Pages/%PAGE_NAME%.vue`,
        pathImport: import.meta.glob(`./Pages/**/*.vue`),
    }
    let DATA = {};

    for (const packageName in packages)
    {
        if(packages[packageName].pages.match.indexOf(name) !== -1)
        {
            DATA = packages[packageName].pages.resolve();
            break;
        }
        else
        {
            DATA.path        = DATA_DEFAULT.path;
            DATA.pathImport  = DATA_DEFAULT.pathImport;
        }
    }

    return {
        path: DATA.path.replace('%PAGE_NAME%', name),
        pathImport: DATA.pathImport,
    }
}

if(document.querySelector('#app-nav'))
{
    const navApp = createApp(Nav)
        .use(PrimeVue)
        .use(ToastService)
        .use(ConfirmationService)
        .mount('#app-nav');
}
if(document.querySelector('#app-auth-services'))
{
    const authServices = createApp(AuthServices)
        .use(PrimeVue)
        .use(ToastService)
        .use(ConfirmationService)
        .mount('#app-auth-services');
}
if(document.querySelector('#app'))
{
    function getPackagesStore()
    {
        let result = {
            state: {

            },
            mutations: {

            }
        };

        for (const packageName in packages)
        {
            const packageStore        = packages[packageName].store;
            result.state[packageName] = packageStore.state;

            for (const packageMutationName in packageStore.mutations)
            {
                result.mutations[packageMutationName] = packageStore.mutations[packageMutationName];
            }
        }

        return result;
    }
    const packagesStore = getPackagesStore();

    // Create a new store instance.
    const store = createStore({
        state () {
            return packagesStore.state;
        },
        mutations: packagesStore.mutations
    });

    const mainApp = createInertiaApp({
        resolve(name) {
            const DATA = getPackageData(name);

            return resolvePageComponent(DATA.path, DATA.pathImport);
        },
        setup({ el, App, props, plugin }) {
            return createApp({ render: () => h(App, props) })
                .mixin({ methods: { route }})
                .use(plugin)
                .use(PrimeVue)
                .use(ToastService)
                .use(DialogService)
                .use(ConfirmationService)
                .use(store)
                .mount(el)
        },
    });

    let ComponentsAsync = {};
    for (const packageName in packages)
    {
        for (const componentAsyncKey in packages[packageName].ComponentsAsync)
        {
            if(!ComponentsAsync.hasOwnProperty(componentAsyncKey))
            {
                ComponentsAsync[componentAsyncKey] = [];
            }

            for (const componentAsyncData of packages[packageName].ComponentsAsync[componentAsyncKey].data)
            {
                ComponentsAsync[componentAsyncKey].push( componentAsyncData );
            }
        }
    }

    store.commit('mainSetComponentsAsync', ComponentsAsync);
}

import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

export function getUserData()
{
    const page = usePage();
    const data = computed(() => page.props);

    let user = {};
    try
    {
        user = data.value.user;
    }
    catch (e)
    {

    }

    return user;
}

export function createPassword() {

    let l = 'qwertyuiopasdfghjklzxcvbnm';

    let result = '';

    for(let i = 1; i <= 12; i++) {
        let o  = Math.floor(Math.random() * (l.length - 1));
        let lr = l.substr(o, 1);

        let n = Math.floor(Math.random() * 4);

        if(n == 1 || n == 4) { lr = lr.toUpperCase() }
        if(n == 3) { lr = Math.floor(Math.random() * 9) }

        result += lr;
    }

    return result;
}