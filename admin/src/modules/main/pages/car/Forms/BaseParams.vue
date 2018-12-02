<template lang="pug">
.comp-car-base-params
    .forms
        el-form(label-width="100px" label-position="left")
            el-form-item(label="车型")
                el-select(v-model="form.model" )
                    el-option(v-for="(item,index) in model" :label="item" :value="item" :key="index")
            el-form-item(label="车辆颜色")
                el-select(v-model="form.color")
                    el-option(v-for="(item,index) in color" :label="item" :value="item" :key="index")
            el-form-item(label="变速箱")
                el-select(v-model="form.gear_box")
                    el-option(v-for="(item,index) in gearBox" :label="item" :value="item" :key="index")
            el-form-item(label="变速箱型号")
                el-input(v-model="form.gear_model")
            el-form-item(label="车门数")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.doors")
            el-form-item(label="座位数")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.chairs")
            el-form-item(label="轮毂材料")
                el-select(v-model="form.wheel")
                    el-option(v-for="(item,index) in hubMaterial" :label="item" :value="item" :key="index")
            el-form-item(label="")
                my-button(type="primary" :click="save") 保存
        el-form(label-width="100px" label-position="left")
            el-form-item(label="长(mm)")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.length")
            el-form-item(label="宽(mm)")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.width")
            el-form-item(label="高(mm)")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.height")
            el-form-item(label="轴距(mm)")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.wheelbase")
            el-form-item(label="行李箱容积(L)")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.capacity")
            el-form-item(label="整备质量(kg)")
                el-input-number(controls-position="right" :min="0" :precision="0" v-model="form.weight")
</template>

<script>
import { model, color, gearBox, hubMaterial } from '../../../lib/carConfig';
export default {
    data() {
        return {
            test: '',
            model,
            color,
            gearBox,
            hubMaterial,
            form: {
                model: '',
                capacity: 500,
                chairs: 4,
                color: '红色',
                doors: 4,
                gear_box: '变速箱',
                gear_model: '变速箱型号X-10',
                hight: 300,
                length: 100,
                pid: 1,
                weight: 600,
                wheel: '不锈钢',
                wheelbase: 400,
                width: 200
            }
        };
    },
    methods: {
        async getInfo() {
            try {
                let { data } = await this.$http.post('/admin/product/base', {
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
                await this.$http.post('/admin/product/basesave', {
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
.comp-car-base-params {
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
