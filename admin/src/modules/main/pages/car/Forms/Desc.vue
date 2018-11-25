<template lang="pug">
.comp-car-desc
    el-form(label-width="80px" label-position="left")
        el-form-item(label="检测师说")
            el-input(type="textarea" rows="5" v-model="form.examiner")
        el-form-item(label="车商说")
            el-input(type="textarea" rows="5" v-model="form.business")
        el-form-item(label="车主说")
            el-input(type="textarea" rows="5" v-model="form.owner")
        el-form-item(label="")
            my-button(type="primary" :click="save") 保存
</template>

<script>

export default {
    data () {
        return {
            form: {
                business: '',
                examiner: '',
                owner: ''
            }
        };
    },
    methods: {
        async getInfo () {
            try {
                let { data } = await this.$http.post('/admin/product/info', {
                    id: this.$route.query.id
                });
                this.form = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        async save () {
            try {
                await this.$http.post('/admin/product/infosave', {
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
