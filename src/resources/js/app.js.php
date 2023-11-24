import './bootstrap';
import packages from './packages';

import { createApp, h } from 'vue';
import { createStore } from 'vuex'

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import ConfirmationService from 'primevue/confirmationservice';

import 'primevue/resources/themes/bootstrap4-light-blue/theme.css'
import 'primeicons/primeicons.css'

import Nav from '$/vendor/la09r/web-fullstack-starter-kit-ui-vue-inertia/src/resources/js/Components/Dashboard/Nav.vue';


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
            DATA = packages[packageName].pages.resolve;
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
if(document.querySelector('#app'))
{
    // Create a new store instance.
    const store = createStore({
        state () {
            return {
                count: 0,
                page: {
                    visibleModalAdd: false,
                },
                component: {
                    'User_List_Index_DataTable': {
                        key: 0
                    }
                },
                asyncComponents: {

                }
            }
        },
        mutations: {
            increment (state) {
                state.count++
            },
            toggleVisibleModalAdd (state) {
                state.page.visibleModalAdd = !state.page.visibleModalAdd;
            },
            setAsyncComponents (state, components) {
                state.asyncComponents = components;
            },
            forceRerender (name) {
                state.component[name].key += 1;
            }
        }
    });

    const mainApp = createInertiaApp({
        resolve(name) {
            const DATA = getPackageData(name, AsyncComponents);

            return resolvePageComponent(DATA.path, DATA.pathImport);
        },
        setup({ el, App, props, plugin }) {
            return createApp({ render: () => h(App, props) })
                .mixin({ methods: { route }})
                .use(plugin)
                .use(PrimeVue)
                .use(ToastService)
                .use(ConfirmationService)
                .use(store)
                .mount(el)
        },
    });

    let AsyncComponents = {};

    for (const packageName in packages)
    {
        AsyncComponents[packageName] = packages[packageName].asyncComponents;
    }

    store.commit('setAsyncComponents', AsyncComponents);
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