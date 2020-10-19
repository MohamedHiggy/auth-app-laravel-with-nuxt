import Vue from 'vue';

import { mapGetters } from 'vuex';

const Validation = {
    install(Vue, options) {
        Vue.mixin({
            computed: {
                ...mapGetters({
                    user: 'user-auth/user',
                    authenticated: 'user-auth/authenticated'
                })
            }
        })
    }
}

Vue.use(Validation);