export default {
    // Global page headers (https://go.nuxtjs.dev/config-head)
    head: {
        title: "laravel-auth",
        meta: [
            { charset: "utf-8" },
            { name: "viewport", content: "width=device-width, initial-scale=1" },
            { hid: "description", name: "description", content: "" }
        ],
        link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }]
    },
    router: {
        middleware: ["clearValidationError"]
    },
    // Global CSS (https://go.nuxtjs.dev/config-css)
    css: [],

    // Auto import components (https://go.nuxtjs.dev/config-components)
    components: true,

    // Modules for dev and build (recommended) (https://go.nuxtjs.dev/config-modules)
    buildModules: [
        '@nuxtjs/moment'
    ],

    moment: {
        timezone: true,
    },

    // Modules (https://go.nuxtjs.dev/config-modules)
    modules: [
        // https://go.nuxtjs.dev/bootstrap
        "bootstrap-vue/nuxt",
        // https://go.nuxtjs.dev/axios
        "@nuxtjs/axios",
        "@nuxtjs/auth",
        "@nuxtjs/toast"
    ],
    toast: {
        position: 'top-right',
        duration: 4000,
        theme: "outline",
        action: {
            text: 'cancel',
            onClick: (e, toastObject) => {
                toastObject.goAway(0);
            }
        }
    },
    // Plugins to run before rendering page (https://go.nuxtjs.dev/config-plugins)
    plugins: [
        "./plugins/mixins/validation",
        './plugins/mixins/user',
        "./plugins/axios",
    ],
    auth: {
        strategies: {
            local: {
                endpoints: {
                    login: { url: "login", method: "post", propertyName: "token" },
                    logout: { url: "logout", method: "post" },
                    user: { url: "me", method: "get", propertyName: "data.user" }
                }
            }
        },
        redirect: {
            login: "/auth/login",
            logout: "/auth/login",
            home: "/"
        },
        plugins: [
            './plugins/auth'
        ]
    },
    // Axios module configuration (https://go.nuxtjs.dev/config-axios)
    axios: {
        baseURL: "http://localhost/api/v1"
    },

    // Build Configuration (https://go.nuxtjs.dev/config-build)
    build: {}
};