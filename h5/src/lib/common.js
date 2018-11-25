import Vue from 'vue';
import axios from './http';
import directives from '../directives';
import './share';

import Header from '../components/Header';
import Banner from '../components/Banner';
import Box from '../components/Box';
import Title from '../components/Title';
import BottomBar from '../components/BottomBar';
import MyNavBar from '../components/MyNavBar';
import KeyValue from '../components/KeyValue';
import Avatar from '../components/Avatar';
import FormSelect from '../components/form/Select';
import FormCarModelPicker from '../components/form/CarModelPicker';
import FormUploader from '../components/form/Uploader';
import FormValidCode from '../components/form/ValidCode';
import FormCarSelector from '../components/form/CarSelector';

import '../style/reset.css';
import '../style/common.scss';

Vue.use(axios);
Vue.use(directives);

document.querySelector('html').style.fontSize =
    document.documentElement.offsetWidth / 25 + 'px';

Vue.config.productionTip = false;

Vue.component('my-header', Header);
Vue.component('my-banner', Banner);
Vue.component('my-box', Box);
Vue.component('my-title', Title);
Vue.component('my-bottom-bar', BottomBar);
Vue.component('my-nav-bar', MyNavBar);
Vue.component('my-key-value', KeyValue);
Vue.component('my-avatar', Avatar);
Vue.component('my-form-select', FormSelect);
Vue.component('my-form-uploader', FormUploader);
Vue.component('my-form-car-model-picker', FormCarModelPicker);
Vue.component('my-form-valid-code', FormValidCode);
Vue.component('my-form-car-selector', FormCarSelector);
