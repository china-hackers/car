<template lang="pug">
.page
    my-nav-bar(title="客户成交")
    van-cell-group
        van-field(label="成交金额" type="number" placeholder="请输入" v-model="form.price")
        my-form-car-selector(label="成交车辆" placeholder="请选择" v-model="form.pid")
    my-bottom-bar.bottom(:click="save")
        .g-bottom-btn 提交
</template>

<script>
export default {
    data () {
        return {
            form: {
                pid: '',
                price: ''
            }
        };
    },
    methods: {
        async save () {
            try {
                await this.$http.post('/mobile/business/productdeal', {
                    ...this.form,
                    id: this.$route.query.id
                });
                this.success('保存成功');
                history.back();
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>
