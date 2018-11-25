<template lang="pug">
.page
    my-nav-bar(title="基本参数")
    van-cell-group
        my-form-select(label="车型" placeholder="请选择" v-model="form.model" :actions="model")
        my-form-select(label="颜色" placeholder="请选择" v-model="form.color" :actions="color")
        my-form-select(label="变速箱" placeholder="请选择" v-model="form.gear_box" :actions="gearBox")
        van-field(label="车门数" placeholder="请输入" type="number" v-model="form.doors")
        van-field(label="座位数" placeholder="请输入" type="number" v-model="form.chairs")
        my-form-select(label="轮毂材料" placeholder="请选择" v-model="form.wheel" :actions="hubMaterial")
        van-field(label="长(mm)" placeholder="请输入" type="number" v-model="form.length")
        van-field(label="宽(mm)" placeholder="请输入" type="number" v-model="form.width")
        van-field(label="高(mm)" placeholder="请输入" type="number" v-model="form.height")
        van-field(label="轴距(mm)" placeholder="请输入" type="number" v-model="form.wheelbase")
        van-field(label="行李箱(L)" placeholder="请输入" type="number" v-model="form.capacity")
        van-field(label="重量(kg)" placeholder="请输入" type="number" v-model="form.weight")
    my-bottom-bar.bottom(:click="save")
        .g-bottom-btn 提交
</template>

<script>
import carEditMixin from '../mixins/carEdit';
export default {
    mixins: [carEditMixin],
    data () {
        return {
            form: {
                model: '',
                color: '',
                gear_box: '',
                gear_model: '',
                chairs: 5,
                doors: 5,
                wheel: '',
                capacity: 0,
                length: 0,
                width: 0,
                height: 0,
                wheelbase: 0,
                weight: 0
            }
        };
    },
    methods: {
        async save () {
            try {
                await this.$http.post('/mobile/product/basesave', {
                    id: this.$route.query.id,
                    ...this.form
                });
                this.success('保存成功');
                history.back();
            } catch (error) {
                console.log(error);
            }
        }
    },
    async created () {
        try {
            let { data } = await this.$http.post('/mobile/product/base', {
                id: this.$route.query.id
            });
            console.log(data);
            // this.form = data.data;
            this.form = {
                model: data['model'],
                color: data['color'],
                gear_box: data['gear_box'],
                gear_model: data['gear_model'],
                chairs: data['chairs'],
                doors: data['doors'],
                wheel: data['wheel'],
                capacity: data['capacity'],
                length: data['length'],
                width: data['width'],
                height: data['height'],
                wheelbase: data['wheelbase'],
                weight: data['weight']
            };
        } catch (error) {
            console.log(error);
        }
    }
};
</script>
