<template lang="pug">
.page-car-form
    my-nav-bar(title="询最低价")
    .title 预购车辆
    car-list(:count="1" type="row" :params="{pid:$route.query.id}")
    .title 详细信息
    van-cell-group.form
        van-field(label="姓名" icon="contact" placeholder="请输入姓名" v-model="form.name")
        van-field(label="电话" icon="phone" placeholder="请输入电话" v-model="form.phone")
    .tips 以上信息仅I品车工作人员可见，请放心填写
    my-bottom-bar.bottom(:click="save")
        .btn 确认
</template>

<script>
import CarList from '@/components/CarList';
export default {
    data() {
        return {
            form: {
                name: '',
                phone: ''
            }
        };
    },
    components: {
        'car-list': CarList
    },
    methods: {
        async save() {
            try {
                await this.$http.post('/mobile/finance/buyadd', {
                    ...this.form,
                    pid: this.$route.query.id
                });
                this.$dialog.alert({
                    message: '保存成功'
                });
                history.back();
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.page-car-form {
    .title {
        padding: 1rem;
    }
    .tips {
        color: red;
        font-size: 0.87rem;
        text-align: center;
        padding: 1rem 0;
    }
    .btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
    }
}
</style>
