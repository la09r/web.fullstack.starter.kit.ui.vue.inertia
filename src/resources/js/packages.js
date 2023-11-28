// package mutation must have unique name in this file

export default {
    main: {
        name: "Main",
        store: {
            state: {
                ComponentsAsync: {

                }
            },
            mutations: {
                mainSetComponentsAsync: function(state, components) {
                    state.main.ComponentsAsync = components;
                },
            }
        },
        pages: {
            match: ['Dashboard/Index', 'Public/Index', 'Error/Index', 'Welcome/Index'],
            resolve: function () {
                return {
                    path: `../../vendor/la09r/web-fullstack-starter-kit-ui-vue-inertia/src/resources/js/Pages/%PAGE_NAME%.vue`,
                    pathImport: import.meta.glob(`../../vendor/la09r/web-fullstack-starter-kit-ui-vue-inertia/src/resources/js/Pages/**/*.vue`),
                }
            }
        },
        Components: {
            'Dashboard': {
                basePath: 'resources/js/Components/Dashboard',
            },
            'Layouts': {
                basePath: 'resources/js/Layouts',
            },
        },
        ComponentsAsync: {
            'Dashboard/Widget': {
                basePath: 'resources/js/ComponentsAsync/Dashboard/Widget',
                data: [
                    { path: 'MainInfo' },
                    { path: 'MainStat' },
                ]
            }
        }
    }

    // add packages here
};

