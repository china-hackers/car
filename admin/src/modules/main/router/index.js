import Vue from 'vue';
import Router from 'vue-router';

import permissionRouter from './permission';
import carRouter from './car';
import userRouter from './user';
import contentRouter from './content';
Vue.use(Router);
let comp = Vue.component('car', {
    template: '<div><router-view></router-view></div>'
});
export default new Router({
    routes: [{
        path: '/',
        component: () =>
                import('../pages/Welcome')
    },
    {
        path: '/finance',
        component: comp,
        children: [{
            path: '',
            component: () =>
                    import('../pages/loan/Finance')
        }, {
            path: 'deal',
            component: () =>
                    import('../pages/loan/FinanceDeal')
        }]
    },
    {
        path: '/insurance',
        component: comp,
        children: [{
            path: '',
            component: () =>
                    import('../pages/safe/Insurance')
        }, {
            path: 'deal',
            component: () =>
                    import('../pages/safe/InsuranceDeal')
        }]

    }, {
        path: '/reset-pwd',
        component: () =>
                import('../pages/ResetPwd.vue')
    },
    permissionRouter,
    carRouter,
    userRouter,
    contentRouter
    ]
});
