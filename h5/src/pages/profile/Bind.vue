<template lang="pug">
.page
    my-nav-bar(title="绑定手机号")
    van-cell-group
        van-field(label="电话" placeholder="请输入电话" v-model="form.phone")
        my-form-valid-code(:phone="form.phone" v-model="form.code")
    my-bottom-bar.bottom(:click="save")
        .g-bottom-btn 提交
</template>

<script>
export default {
    data () {
        return {
            form: {
                phone: '',
                code: ''
            }
        };
    },
    methods: {
        async save () {
            try {
                await this.$http.post('/mobile/user/bindphone', this.form);
                this.success('绑定成功');
                history.back();
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>
