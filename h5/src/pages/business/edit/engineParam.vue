<template lang="pug">
.page
    my-nav-bar(title="发动机参数")
    van-cell-group
        van-field(label="油耗(L)" placeholder="请输入" type="number" v-model="form.oil_wear")
        van-field(label="排量(L)" placeholder="请输入" type="number" v-model="form.displacement")
        van-field(label="油箱(L)" placeholder="请输入" type="number" v-model="form.oil_capacity")
        my-form-select(label="进气形式" placeholder="请选择" v-model="form.air_in" :actions="inlet")
        van-field(label="扭矩(N.m)" placeholder="请输入" type="number" v-model="form.nm")
        my-form-select(label="燃油" placeholder="请选择" v-model="form.oil" :actions="fuel")
        my-form-select(label="燃油标号" placeholder="请选择" v-model="form.oil_no" :actions="fuelLabel")
        van-field(label="功率(kw)" placeholder="请输入" type="number" v-model="form.power")
        van-field(label="最高车速(km/h)" placeholder="请输入" type="number" v-model="form.speed")
        van-field(label="零百加速(s)" placeholder="请输入" type="number" v-model="form.speed_up")
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
                oil_wear: 0,
                displacement: 0,
                air_in: '',
                nm: 0,
                oil: '',
                oil_capacity: 0,
                oil_no: '',
                power: 0,
                speed: 0,
                speed_up: 0
            }
        };
    },
    methods: {
        async save () {
            try {
                await this.$http.post('/mobile/product/enginesave', {
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
            let { data } = await this.$http.post('/mobile/product/engine', {
                id: this.$route.query.id
            });
            this.form = {
                oil_wear: data['oil_wear'],
                displacement: data['displacement'],
                air_in: data['air_in'],
                nm: data['nm'],
                oil: data['oil'],
                oil_capacity: data['oil_capacity'],
                oil_no: data['oil_no'],
                power: data['power'],
                speed: data['speed'],
                speed_up: data['speed_up']
            };
        } catch (error) {
            console.log(error);
        }
    }
};
</script>
