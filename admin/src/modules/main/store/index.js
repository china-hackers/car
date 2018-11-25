import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);
export default new Vuex.Store({
    state: {
        app: {
            sidebar: {
                opened: true
            }
        },
        user: {}
    },
    getters: {
        sidebar: state => state.app.sidebar,
        device: state => state.app.device,
        token: state => state.user.token,
        avatar: state => state.user.avatar,
        name: state => state.user.name,
        roles: state => state.user.roles
    }
});
