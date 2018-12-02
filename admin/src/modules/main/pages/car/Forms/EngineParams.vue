<template lang="pug">
.comp-car-engine-params
    .forms
        el-form(label-width="120px" label-position="left")
            el-form-item(label="百公里油耗(L)")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.oil_wear")
            el-form-item(label="排量(L)")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.displacement")
            el-form-item(label="邮箱容积(L)")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.oil_capacity")
            el-form-item(label="进气形式")
                el-select(v-model="form.air_in")
                    el-option(v-for="(item,index) in inlet" :label="item" :value="item" :key="index")
            el-form-item(label="最大扭矩(N.m)")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.nm")

            el-form-item(label="")
                my-button(type="primary" :click="save") 保存
        el-form(label-width="120px" label-position="left")
            el-form-item(label="燃油")
                el-select(v-model="form.oil")
                    el-option(v-for="(item,index) in fuel" :label="item" :value="item" :key="index")
            el-form-item(label="燃油标号")
                el-select(v-model="form.oil_no")
                    el-option(v-for="(item,index) in fuelLabel" :label="item" :value="item" :key="index")
            el-form-item(label="功率(kw)")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.power")
            el-form-item(label="最高车速(km/h)")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.speed")
            el-form-item(label="官方0-100加速(s)")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.speed_up")

</template>

<script>
import { inlet, fuel, fuelLabel } from '../../../lib/carConfig';
export default {
    data() {
        return {
            inlet,
            fuel,
            fuelLabel,
            form: {
                air_in: '进气方式',
                displacement: 400,
                nm: 200,
                oil: '200',
                oil_capacity: 200,
                oil_no: '#95',
                oil_wear: 200,
                pid: 1,
                power: 0,
                speed: 180,
                speed_up: 100
            }
        };
    },
    methods: {
        async getInfo() {
            try {
                let { data } = await this.$http.post('/admin/product/engine', {
                    id: this.$route.query.id
                });
                console.log(data);
                this.form = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        async save() {
            try {
                await this.$http.post('/admin/product/enginesave', {
                    id: this.$route.query.id,
                    ...this.form
                });
                this.success('保存成功');
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getInfo();
    }
};
</script>

<style lang="scss" scoped>
.comp-car-engine-params {
    .forms {
        display: flex;
        .el-form {
            &:last-child {
                padding-left: 40px;
            }
        }
    }
}
</style>
