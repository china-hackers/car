import Vue from 'vue';

let comp = Vue.component('car', {
    template: '<div><router-view></router-view></div>'
});
export default {
    path: '/car',
    component: comp,
    children: [{
        path: 'lib',
        component: () =>
            import('../pages/car/Lib')
    }, {
        path: 'edit',
        component: () =>
            import('../pages/car/Editor')
    }, {
        path: 'add',
        component: () =>
            import('../pages/car/Editor')
    }, {
        path: 'types',
        component: () =>
            import('../pages/car/Types')
    }, {
        path: 'order',
        component: () =>
            import('../pages/car/Order')
    }]
};
