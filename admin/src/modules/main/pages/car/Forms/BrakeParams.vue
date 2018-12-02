<template lang="pug">
.comp-car-brake-params
    el-form(label-width="120px" label-position="left")
        el-form-item(label="前制动")
            el-select(v-model="form.head_drive")
                el-option(v-for="(item,index) in brake" :label="item" :value="item" :key="index")
        el-form-item(label="后制动")
            el-select(v-model="form.back_drive")
                el-option(v-for="(item,index) in brake" :label="item" :value="item" :key="index")
        el-form-item.tyre(label="前轮胎规格(mm)")
            el-input(placeholder="195/65R15" v-model="form.head_std")
        el-form-item.tyre(label="后轮胎规格(mm)")
            el-input(placeholder="195/65R15" v-model="form.back_std")
        el-form-item(label="")
            my-button(type="primary" :click="save") 保存
</template>

<script>
import { brake } from '../../../lib/carConfig';
export default {
    data() {
        return {
            test: '',
            brake,
            form: {
                head_drive: '',
                back_drive: '',
                head_std: '',
                back_std: ''
            }
        };
    },
    methods: {
        async getInfo() {
            try {
                let { data } = await this.$http.post('/admin/product/tyre', {
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
                await this.$http.post('/admin/product/tyresave', {
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
.comp-car-brake-params {
    .tyre {
        span {
            padding: 0 10px;
        }
    }
}
</style>
