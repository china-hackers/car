import Vue from 'vue';

import PageTitle from '../components/PageTitle';
import CommonBar from '../components/CommonBar';
import NoteEditor from '../components/NoteEditor';
import Image from '../components/Image';
import FormImages from '@/components/form/Images';
import KeyValue from '../components/KeyValue';

Vue.component('my-page-title', PageTitle);
Vue.component('my-common-bar', CommonBar);
Vue.component('my-note-editor', NoteEditor);
Vue.component('my-image', Image);
Vue.component('my-form-images', FormImages);
Vue.component('my-key-value', KeyValue);
