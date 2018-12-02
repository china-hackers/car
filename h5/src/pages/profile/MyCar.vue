<template lang="pug">
.page-my-car
    my-nav-bar(title="我的爱车")
    van-cell-group
        van-field(label="车牌号" placeholder="请输入车牌号" v-model="form.car_no")
        my-form-car-model-picker(label="车辆型号" placeholder="请选择" :data="carModels" v-model="form.car_id")
        van-field(label="车辆总价(万)" placeholder="请输入车辆总价(万元)" v-model="form.car_price")
    my-bottom-bar.bottom(:click="save")
        .g-bottom-btn 提交
</template>

<script>
import { mapState } from 'vuex';
export default {
    data() {
        return {
            form: {
                car_no: '',
                car_id: 0,
                car_price: ''
            }
        };
    },
    computed: mapState({
        carModels: state => state.carModels
    }),
    methods: {
        async getMyCar() {
            try {
                let { data } = await this.$http.post('/mobile/user/car', {
                    p: 1
                });
                Object.assign(this.form, data);
            } catch (error) {
                console.log(error);
            }
        },
        async save() {
            try {
                await this.$http.post('/mobile/user/carsave', this.form);
                this.success('保存成功');
                history.back();
            } catch (error) {
                console.log(error);
            }
        }
    },
    created() {
        this.getMyCar();
    }
};
</script>
