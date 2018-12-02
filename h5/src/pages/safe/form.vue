<template lang="pug">
.page-safe-form
    my-nav-bar(title="I品车险")
    van-cell-group
        van-field(label="姓名" placeholder="请输入姓名" v-model="form.name")
        van-field(label="电话" placeholder="请输入电话" v-model="form.phone")
        van-field(label="车牌号" placeholder="请输入车牌号" v-model="form.car_no")
        my-form-car-model-picker(label="车辆型号" placeholder="请选择" :data="carModels" v-model="form.car_id")
    my-bottom-bar.bottom(:click="save")
        .g-bottom-btn 立即报价
</template>
<script>
import { mapState } from 'vuex';
export default {
    data() {
        return {
            form: {
                name: '',
                phone: '',
                car_no: '',
                car_id: 0
            }
        };
    },
    computed: mapState({
        carModels: state => state.carModels
    }),
    methods: {
        async save() {
            try {
                await this.$http.post('/mobile/finance/safeadd', this.form);
                this.success('保存成功');
                history.back();
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>
