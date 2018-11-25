<template lang="pug">
el-dialog(title="保险成交" :visible.sync="visible" width="800px")
    el-form.form(label-width="150px" label-position="left")
        el-form-item(label="成交姓名")
            el-input(v-model="form.d_name")
        el-form-item(label="成交电话")
            el-input(type="tel" v-model="form.d_phone")
        el-form-item(label="成交车牌号")
            el-input(v-model="form.d_car_no")
        el-form-item(label="成交车型")
            el-cascader(:options="carModelData" v-model="form.car")
        el-form-item(label="交强险到期时间")
            el-date-picker(type="date" v-model="form.d_j_outdate" value-format="yyyy-MM-dd")
        el-form-item(label="商业险到期时间")
            el-date-picker(type="date" v-model="form.d_s_outdate" value-format="yyyy-MM-dd")
        el-form-item(label="车险项目")
            my-key-value(v-model="form.options")
        el-form-item(label="车险总价(元)")
            el-input-number(:min="0" :precision="0" v-model="form.d_price")
        my-form-images(label="用户资料" :size="100" action="/admin/site/safeimg" v-model="form.imgs")
        el-form-item
            my-button(type="primary" :click="save") 保存
</template>

<script>
import dialogMixin from '@/mixins/dialog';
export default {
    mixins: [dialogMixin],
    data () {
        return {
            carModelData: [],
            form: {
                'id': 1,
                'd_name': '',
                'd_phone': '',
                'd_car_no': '',
                'd_car_id': 0,
                'd_s_outdate': '',
                'd_j_outdate': '',
                'd_price': 0,
                'options': [],
                car: [],
                imgs: []
            }
        };
    },
    methods: {
        async save () {
            try {
                this.form.d_car_id = this.form.car[2];
                await this.$http.post('/admin/finance/safecheck', this.form);
                this.success('保存成功');
                this.$emit('success');
                this.close();
            } catch (error) {
                console.log(error);
            }
        },
        setId (id) {
            this.form.id = id;
            this.getInfo();
        },
        async getInfo () {
            try {
                let {data} = await this.$http.post('/admin/finance/safe', {
                    id: this.form.id
                });
                console.log(data);
                Object.assign(this.form, {
                    'd_name': data.data['d_name'],
                    'd_phone': data.data['d_phone'],
                    'd_car_no': data.data['d_car_no'],
                    'd_car_id': data.data['d_car_id'],
                    'd_s_outdate': data.data['d_s_outdate'],
                    'd_j_outdate': data.data['d_j_outdate'],
                    'd_price': data.data['d_price'],
                    'options': data.data['options'],
                    'car': data.data['car'],
                    'imgs': data.data['imgs']
                });
            } catch (error) {
                console.log(error);
            }
        },
        async getCarModel () {
            try {
                let { data } = await this.$http.post('/admin/car/cars', {p: 1});
                this.carModelData = data.data;
            } catch (error) {
                console.log(error);
            }
        }
    },
    created () {
        this.getCarModel();
    }
};
</script>
