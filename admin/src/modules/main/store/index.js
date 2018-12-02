import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);
export default new Vuex.Store({
    state: {
        originUnread: {
            buy: 0,
            loan: 0,
            safe: 0
        },
        curUnread: {
            buy: 0,
            loan: 0,
            safe: 0
        }
    },

    mutations: {
        SET_ORIGIN_UNREAD(state, data) {
            Object.assign(state.originUnread, data);
        },
        SET_CUR_UNREAD(state, data) {
            Object.assign(state.curUnread, data);
        },
        UPDATE_ORIGIN_BUY(state) {
            if (state.curUnread.buy !== 0) {
                state.originUnread.buy = state.curUnread.buy;
            }
        },
        UPDATE_ORIGIN_LOAN(state) {
            if (state.curUnread.loan !== 0) {
                state.originUnread.loan = state.curUnread.loan;
            }
        },
        UPDATE_ORIGIN_SAFE(state) {
            if (state.curUnread.safe !== 0) {
                state.originUnread.safe = state.curUnread.safe;
            }
        }
    },
    actions: {
        async getFirstUnread(store) {
            try {
                let { data } = await Vue.prototype.$http.post(
                    '/admin/finance/count',
                    {
                        p: 1
                    }
                );
                store.commit('SET_ORIGIN_UNREAD', data.data);
            } catch (error) {
                console.log(error);
            }
        },
        async getUnread(store) {
            try {
                let { data } = await Vue.prototype.$http.post(
                    '/admin/finance/count',
                    {
                        p: 1
                    }
                );
                store.commit('SET_CUR_UNREAD', data.data);
            } catch (error) {
                console.log(error);
            }
        }
    }
});
