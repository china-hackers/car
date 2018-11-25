import Vue from 'vue';
import axios from '../../lib/http';
import lodash from '../../lib/lodash';
import msg from '../../lib/msg';
import directives from '../../directives';
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/zh-CN';
import Index from './Index.vue';

import '../../lib/commonComponents';

import '../../style/reset.css';
import '../../style/element-variables.scss';
import '../../style/common.scss';
Vue.use(axios);
Vue.use(lodash);
Vue.use(ElementUI, {
    locale
});
Vue.use(msg);
Vue.use(directives);

Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
    el: '#app',
    components: {
        Index
    },
    template: `<Index/>`
});
