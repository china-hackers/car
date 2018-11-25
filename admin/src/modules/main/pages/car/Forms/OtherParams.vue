<template lang="pug">
.comp-car-other-params
    el-form(label-width="120px" label-position="left")
        el-form-item.tyre(label="首付")
            el-input-number(controls-position="right" :min="0" :precision="2" v-model="form.shoufu")
            span.unit 元
        el-form-item.tyre(label="月供")
            el-input-number(controls-position="right" :min="0" :precision="2" v-model="form.yuegong")
            span.unit 元
        el-form-item(label="年检到期")
            el-date-picker(type="date" value-format="yyyy-MM-dd" v-model="form.nian_date")
        el-form-item(label="交强险到期")
            el-date-picker(type="date" value-format="yyyy-MM-dd" v-model="form.jiao_date")
        el-form-item.tyre(label="商业险到期")
            el-date-picker(type="date" value-format="yyyy-MM-dd" v-model="form.shang_date")
        el-form-item.tyre(label="新车质保到期")
            el-date-picker(type="date" value-format="yyyy-MM-dd" v-model="form.zhi_date")

        el-form-item(label="")
            my-button(type="primary" :click="save") 保存
</template>

<script>
export default {
    data () {
        return {
            form: {
                nian_date: '',
                jiao_date: '',
                shang_date: '',
                zhi_date: '',
                shoufu: '',
                yuegong: ''
            }
        };
    },
    methods: {
        async getInfo () {
            try {
                let { data } = await this.$http.post('/admin/product/tax', {
                    id: this.$route.query.id
                });
                console.log(data);
                this.form = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        async save () {
            try {
                await this.$http.post('/admin/product/taxsave', {
                    id: this.$route.query.id,
                    ...this.form
                });
                this.success('保存成功');
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted () {
        this.getInfo();
    }
};
</script>

<style lang="scss" scoped>
</style>
