<template lang="pug">
.comp-car-base-info
    el-form.form(label-width="100px" label-position="left")
        el-form-item(label="车商")
            el-input(v-model="form.business" disabled)
        el-form-item(label="销售员")
            el-input(v-model="form.user" disabled)
        el-form-item(label="I品车")
            el-input(v-model="form.itype" disabled)
        el-form-item(label="标题")
            el-input(v-model="form.title")
        el-form-item(label="车型")
            el-cascader(:options="carModelData" v-model="form.car")
        el-form-item(label="卖价")
            el-input-number(controls-position="right" :min="0" :precision="2" v-model="form.price")
            span.unit 万元
        el-form-item(label="新车价")
            el-input-number(controls-position="right" :min="0" :precision="2" v-model="form.price_new")
            span.unit 万元
        el-form-item(label="新车购置税")
            el-input-number(controls-position="right" :min="0" :precision="2" v-model="form.tax")
            span.unit 万元
        el-form-item(label="上牌时间")
            el-date-picker(type="date" v-model="form.reg_date" value-format="yyyy-MM-dd")
        el-form-item(label="行驶里程")
            el-input-number(controls-position="right" :min="0" :precision="2" v-model="form.km")
            span.unit 万公里
        el-form-item(label="归属地")
            el-cascader(:options="cityData" v-model="form.city")
        el-form-item(label="排放标准")
            el-select(v-model="form.emission_std")
                el-option(v-for="(item, index) in gas" :label="item" :value="item" :key="index")
    .submit
        my-button(type="primary" :click="save") 保存
</template>

<script>
import { gas } from '../../../lib/carConfig';
export default {
    data () {
        return {
            gas: gas,
            carModelData: [],
            cityData: [],
            form: {
                id: 1,
                itype: '',
                business: '',
                user: '',
                title: '',
                price: '',
                price_new: '',
                tax: '',
                reg_date: '',
                km: '',
                city_id: 100,
                city: [],
                emission_std: '',
                car_id: 1
            }
        };
    },
    methods: {
        async save () {
            try {
                await this.$http.post('/admin/product/productsave', {
                    id: this.form.id,
                    business_id: this.form.business_id,
                    car_id: this.form.car.length ? this.form.car[this.form.car.length - 1] : '',
                    city_id: this.form.city.length ? this.form.city[this.form.city.length - 1] : '',
                    emission_std: this.form.emission_std,
                    itype: this.form.itype,
                    km: this.form.km + '',
                    price: this.form.price,
                    price_new: this.form.price_new,
                    reg_date: this.form.reg_date,
                    tax: this.form.tax,
                    user_id: this.form.user_id
                });
                this.success('保存成功');
            } catch (error) {
                console.log(error);
            }
        },
        async getInfo () {
            try {
                let { data } = await this.$http.post('/admin/product/product', {
                    id: this.$route.query.id
                });
                this.form = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        async getCarModel () {
            try {
                let { data } = await this.$http.post('/admin/car/cars', {p: 1});
                console.log(data);
                this.carModelData = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        async getCitys () {
            try {
                let { data } = await this.$http.post('/mobile/city/cities', {p: 1});
                this.cityData = data.data;
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted () {
        this.getCarModel();
        this.getCitys();
        this.getInfo();
    }
};
</script>

<style lang="scss" scoped>
.comp-car-base-info {
    .form {
        display: flex;
        align-items: flex-start;
        flex-wrap: wrap;
        .el-form-item {
            box-sizing: border-box;
            width: 50%;
            padding-right: 100px;
        }
        .el-cascader {
            width: 250px;
        }
    }
}
</style>
