import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

let comp = Vue.component('routerview', {
    template: '<div class=fullheight><router-view></router-view></div>'
});

let router = new Router({
    routes: [{
        path: '',
        redirect: '/main'
    }, {
        path: '/main',
        component: () =>
            import('../Index.vue'),
        children: [{
            path: '',
            redirect: 'home'
        }, {
            path: 'home',
            component: () =>
                import('../pages/home/Index')
        }, {
            path: 'car',
            component: () =>
                import('../pages/car/Index')
        }, {
            path: 'profile',
            component: () =>
                import('../pages/profile/Index')
        }, {
            path: 'loan',
            component: () =>
                import('../pages/loan/index')
        }]
    }, {
        path: '/life',
        component: () =>
            import('../pages/life/Index')
    }, {
        path: '/car',
        component: comp,
        children: [{
            path: 'detail',
            component: () =>
                import('../pages/car/Detail')
        }, {
            path: 'form',
            component: () =>
                import('../pages/car/Form')
        }, {
            path: 'param',
            component: () =>
                import('../pages/car/Param')
        }]
    }, {
        path: '/my',
        component: comp,
        children: [{
            path: 'qr',
            component: () =>
                import('../pages/profile/MyQr')
        }, {
            path: 'ioan',
            component: () =>
                import('../pages/profile/MyIoan')
        }, {
            path: 'car-insurance',
            component: () =>
                import('../pages/profile/MyCarInsurance')
        }, {
            path: 'invite',
            component: () =>
                import('../pages/profile/MyInvite')
        }, {
            path: 'mycar',
            component: () =>
                import('../pages/profile/MyCar')
        }, {
            path: 'join',
            component: () =>
                import('../pages/profile/Join')
        }, {
            path: 'bind',
            component: () =>
                import('../pages/profile/Bind')
        }, {
            path: 'collect',
            component: () =>
                import('../pages/profile/MyCollect')
        }]
    }, {
        path: '/loan',
        component: comp,
        children: [{
            path: '',
            component: () =>
                import('../pages/loan/index')
        }, {
            path: 'form',
            component: () =>
                import('../pages/loan/form')
        }]
    }, {
        path: '/safe',
        component: comp,
        children: [{
            path: '',
            component: () =>
                import('../pages/safe/index')
        }, {
            path: 'form',
            component: () =>
                import('../pages/safe/form')
        }]
    }, {
        path: '/business',
        component: comp,
        children: [{
            path: '',
            component: () => import('../pages/business/index')
        }, {
            path: 'new',
            component: () => import('../pages/business/new')
        }, {
            path: 'edit',
            component: () => import('../pages/business/edit/index')
        }, {
            path: 'edit/desc',
            component: () => import('../pages/business/edit/desc')
        }, {
            path: 'edit/base-info',
            component: () => import('../pages/business/edit/baseInfo')
        }, {
            path: 'edit/base-param',
            component: () => import('../pages/business/edit/baseParam')
        }, {
            path: 'edit/engine-param',
            component: () => import('../pages/business/edit/engineParam')
        }, {
            path: 'edit/dipan-param',
            component: () => import('../pages/business/edit/dipanParam')
        }, {
            path: 'edit/brake-param',
            component: () => import('../pages/business/edit/brakeParam')
        }, {
            path: 'edit/file-info',
            component: () => import('../pages/business/edit/fileInfo')
        }, {
            path: 'edit/images',
            component: () => import('../pages/business/edit/images')
        }, {
            path: 'cars',
            component: () => import('../pages/business/cars')
        }, {
            path: 'cars',
            component: () => import('../pages/business/cars')
        }, {
            path: 'salers',
            component: () => import('../pages/business/salers')
        }, {
            path: 'info',
            component: () => import('../pages/business/info')
        }, {
            path: 'customers',
            component: () => import('../pages/business/customers')
        }, {
            path: 'customers/deal',
            component: () => import('../pages/business/makeDeal')
        }, {
            path: 'qr',
            component: () => import('../pages/business/qr')
        }]
    }]
});

export default router;
