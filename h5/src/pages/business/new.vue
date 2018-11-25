<template lang="pug">
.page
    my-nav-bar(title="新增车辆")
    van-cell-group
        van-field(label="标题" placeholder="请输入" v-model="form.title")
        my-form-car-model-picker(label="车型" placeholder="请选择" :data="carModels" v-model="form.car_id")
        van-field(label="卖价(万)" placeholder="请输入" type="numner" v-model="form.price")
        van-field(label="新车价(万)" placeholder="请输入" type="numner" v-model="form.price_new")
        van-field(label="购置税(万)" placeholder="请输入" type="numner" v-model="form.tax")
        van-field(label="上牌时间" type="date" placeholder="请输入" v-model="form.reg_date")
        van-field(label="里程(万)" placeholder="请输入" type="numner" v-model="form.km")
        van-field(label="归属地" placeholder="请输入" v-model="cityName" :disabled="true")
        my-form-select(label="排放标准" placeholder="请选择" v-model="form.emission_std" :actions="gas")
    my-bottom-bar.bottom(:click="save")
        .g-bottom-btn 提交
</template>

<script>
import {mapState} from 'vuex';
import carEditMixin from './mixins/carEdit';
export default {
    mixins: [carEditMixin],
    data () {
        return {
            cityName: '成都',
            form: {
                title: '',
                price: '',
                price_new: '',
                tax: '',
                reg_date: '',
                km: '',
                city_id: 2701,
                emission_std: '',
                car_id: 1
            }

        };
    },
    computed: mapState({
        carModels: state => state.carModels
    }),
    methods: {
        async save () {
            try {
                let {data} = await this.$http.post('/mobile/product/productsave', this.form);
                console.log(data);
                this.success('新增成功');
                this.$router.replace({
                    path: '/business/edit',
                    query: {
                        id: data.id
                    }
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
    created () {
    }
};
</script>
