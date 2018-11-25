import Vue from 'vue';

let comp = Vue.component('user', {
    template: '<div><router-view></router-view></div>'
});
export default {
    path: '/user',
    component: comp,
    children: [{
        path: 'index',
        component: () =>
            import('../pages/user/Index')
    }, {
        path: 'dealer-list',
        component: () =>
            import('../pages/user/DealerList')
    }, {
        path: 'dealer-detail',
        component: () =>
            import('../pages/user/DealerDetail')
    }, {
        path: 'saler-list',
        component: () =>
            import('../pages/user/SalerList')
    }]
};
