import axios from 'axios';
import Vue from 'vue';
import jsonp from 'jsonp';

var instance = axios.create({
    timeout: 15000,
    headers: {
        'X-Requested-With': 'XMLHttpRequest'
    }
});

instance.interceptors.response.use(
    res => {
        if (res.data) {
            if (res.data.code === 200) {
                return res;
            } else {
                if (res.data.code === 300) {
                    window.location.href = '/admin/login';
                } else {
                    Vue.prototype.error(res.data.message);
                    return Promise.reject(res);
                }
            }
            Vue.prototype.error('后台错误');
            return Promise.reject(res);
        }
        return Promise.reject(res);
    },
    err => {
        Vue.prototype.error('网络错误');
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

instance.jsonp = (url, params) => {
    let urlScheme = [];
    Object.keys(params).forEach(key => {
        urlScheme.push(`${key}=${params[key]}`);
    });
    urlScheme = urlScheme.join('&');
    url += url.indexOf('?') === -1 ? '?' : '&';
    url += urlScheme;
    return new Promise(resolve => {
        jsonp(
            url,
            {
                param: 'jsCallback',
                name: `jsonp${new Date().getTime()}`
            },
            (d1, data) => {
                resolve(data);
            }
        );
    });
};

export default {
    install(Vue) {
        Vue.prototype.$http = instance;
    }
};
