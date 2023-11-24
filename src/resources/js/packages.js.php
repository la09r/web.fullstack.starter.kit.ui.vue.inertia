export default {
    main: {
        name: "Main",
        pages: {
            match: ['Dashboard/Index', 'Public/Index', 'Error/Index', 'Welcome/Index'],
            resolve: {
                path: `../../vendor/la09r/web-fullstack-starter-kit-ui-vue-inertia/src/resources/js/Pages/%PAGE_NAME%.vue`,
                pathImport: import.meta.glob(`../../vendor/la09r/web-fullstack-starter-kit-ui-vue-inertia/src/resources/js/Pages/**/*.vue`),
            }
        },
        asyncComponents: {
            Dashboard: {
                Widget: [
                    { name: 'MainInfo' }, { name: 'MainStat' }
                ]
            }
        }
    }

    // add packages here
};

