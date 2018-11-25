import Vue from 'vue';
import './lib/common';
/* eslint-disable */
import {
    Lazyload,
    Toast,
    Dialog,
    ImagePreview,
    Uploader
} from 'vant';
import Vant from 'vant';
import router from './router';
import store from './store';
import 'vant/lib/vant-css/index.css';

Uploader.methods.readFile = function () {
    return new Promise(resolve => {
        resolve('')
    });
}

Vue.use(Vant);
Vue.use(Lazyload);

console.log(Vant)
Vue.prototype.success = Toast.success;
Vue.prototype.fail = Toast.fail;
Vue.prototype.alert = (message) => {
    return Dialog.alert({
        message
    });
}
Vue.prototype.confirm = (message) => {
    return Dialog.confirm({
        message
    });
}
Vue.prototype.ImagePreview = ImagePreview;
Vue.prototype.loading = {
    show(msg) {
        Toast.loading({
            mask: true,
            message: msg
        });
    },
    clear() {
        Toast.clear();
    }
}

Vue.config.productionTip = false;

let Index = Vue.component('Index', {
    template: '<div class=frame><router-view></router-view></div>'
});

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    store,
    components: {
        Index
    },
    template: '<Index />'
});
