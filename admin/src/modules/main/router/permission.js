import Vue from 'vue';

let comp = Vue.component('permission', {
    template: '<div><router-view></router-view></div>'
});
export default {
    path: '/permission',
    component: comp,
    children: [{
        path: 'admin-list',
        component: () =>
            import('../pages/permission/AdminList')
    }, {
        path: 'list',
        component: () =>
            import('../pages/permission/PermissionList')
    }, {
        path: 'role-list',
        component: () =>
            import('../pages/permission/RoleList')
    }]
};
