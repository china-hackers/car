export default {
    install(Vue) {
        let loading = {};
        Vue.prototype.loading = () => {
            loading = Vue.prototype.$loading({
                lock: true
            });
        };
        Vue.prototype.closeLoading = () => {
            loading.close && loading.close();
        };
        Vue.prototype.success = (message = '', title = '成功') => {
            Vue.prototype.$notify({
                title: title,
                message: message,
                type: 'success',
                position: 'bottom-right'
            });
        };
        Vue.prototype.warning = (message = '', title = '警告') => {
            Vue.prototype.$notify({
                title: title,
                message: message,
                type: 'warning',
                position: 'bottom-right'
            });
        };
        Vue.prototype.info = (message = '', title = '消息') => {
            Vue.prototype.$notify({
                title: title,
                message: message,
                type: 'info',
                position: 'bottom-right'
            });
        };
        Vue.prototype.error = (message = '', title = '错误') => {
            Vue.prototype.$notify({
                title: title,
                message: message,
                type: 'error',
                position: 'bottom-right'
            });
        };
    }
};
