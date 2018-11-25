import Vue from 'vue';

let comp = Vue.component('my-content', {
    template: '<div><router-view></router-view></div>'
});
export default {
    path: '/content',
    component: comp,
    children: [{
        path: 'banner',
        component: () =>
            import('../pages/content/banner')
    }, {
        path: 'tuijian',
        component: () =>
            import('../pages/content/Tuijian')
    }]
};
