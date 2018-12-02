import Vue from 'vue';
import Vuex from 'vuex';
import * as config from '@/lib/config';
Vue.use(Vuex);
let store = new Vuex.Store({
    state: {
        brands: [],
        carModels: [],
        carConfig: config
    },
    mutations: {
        setBrands(state, brands) {
            state.brands = brands;
        },
        setCarModels(state, carModels) {
            state.carModels = carModels;
        }
    },
    actions: {
        async getBrands({ commit }) {
            try {
                let { data } = await Vue.prototype.$http.post(
                    '/mobile/car/brands',
                    {
                        p: 1
                    }
                );
                commit('setBrands', data);
            } catch (error) {
                console.log(error);
            }
        },
        async getCarModels({ commit }) {
            try {
                let { data } = await Vue.prototype.$http.post(
                    '/mobile/car/cars',
                    {
                        p: 1
                    }
                );
                commit('setCarModels', data);
            } catch (error) {
                console.log(error);
            }
        }
    }
});

store.dispatch('getBrands');
store.dispatch('getCarModels');

export default store;
