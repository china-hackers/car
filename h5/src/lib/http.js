import axios from 'axios';
import Vue from 'vue';

var instance = axios.create({
    timeout: 15000,
    headers: {
        'X-Requested-With': 'XMLHttpRequest'
    }
});

instance.interceptors.request.use(config => {
    return config;
});

instance.interceptors.response.use(
    res => {
        if (res.data) {
            if (res.data.code === 200) {
                return res.data;
            } else {
                Vue.prototype.$dialog.alert({
                    message: res.data.message
                });
            }
            return Promise.reject(res.data);
        }
    },
    err => {
        Vue.prototype.$dialog.alert({
            message: '网络错误'
        });
        return Promise.reject(err);
    }
);

instance.openWindow = (url, query = {}) => {
    let queryString = [];
    Object.keys(query).forEach(key => {
        queryString.push(`${key}=${query[key]}`);
    });
    queryString = queryString.join('&');
    if (url.indexOf('?') === -1) {
        url = `${url}?${queryString}`;
    } else {
        url = `${url}&${queryString}`;
    }
    let a = document.createElement('a');
    a.target = '_blank';
    a.href = url;
    a.click();
    a.remove();
};

export default {
    install(Vue) {
        Vue.prototype.$http = instance;
    }
};

export { instance };
