<template lang="pug">
.page-employee
    my-page-title(title="修改密码")
    el-form(label-width="120px" label-position="left")
        el-form-item(label="新密码")
            el-input(v-model="pswd")
        el-form-item(label="")
            my-button(type="primary" :click="save") 保存
</template>

<script>
export default {
    data () {
        return {
            pswd: ''
        };
    },
    methods: {
        async save () {
            try {
                await this.$http.post('/admin/admin/password', {
                    pswd: this.pswd
                });
                this.success('修改成功');
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>
