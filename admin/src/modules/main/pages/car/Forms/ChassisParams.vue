<template lang="pug">
.comp-car-desc
    el-form(label-width="120px" label-position="left")
        el-form-item(label="驱动方式")
            el-select(v-model="form.dirve_type")
                el-option(v-for="(item,index) in drivingModel" :label="item" :value="item" :key="index")
        el-form-item(label="转向系统")
            el-select(v-model="form.turn_sys")
                el-option(v-for="(item,index) in steeringSystem" :label="item" :value="item" :key="index")
        el-form-item(label="前悬挂")
            el-select(v-model="form.head_sys")
                el-option(v-for="(item,index) in suspensionSystem" :label="item" :value="item" :key="index")
        el-form-item(label="后悬挂")
            el-select(v-model="form.back_sys")
                el-option(v-for="(item,index) in suspensionSystem" :label="item" :value="item" :key="index")

        el-form-item(label="")
            my-button(type="primary" :click="save") 保存
</template>

<script>
import {
    drivingModel,
    steeringSystem,
    suspensionSystem
} from '../../../lib/carConfig';
export default {
    data() {
        return {
            test: '',
            drivingModel,
            steeringSystem,
            suspensionSystem,
            form: {
                dirve_type: '',
                turn_sys: '',
                head_sys: '',
                back_sys: ''
            }
        };
    },
    methods: {
        async getInfo() {
            try {
                let { data } = await this.$http.post('/admin/product/under', {
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
                await this.$http.post('/admin/product/undersave', {
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
