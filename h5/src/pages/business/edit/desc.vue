<template lang="pug">
.page
    my-nav-bar(title="车辆描述")
    van-cell-group
        van-field(label="检测师说" placeholder="请输入" v-model="form.examiner")
        van-field(label="专家说" placeholder="请输入" v-model="form.business")
        van-field(label="车主说" placeholder="请输入" v-model="form.owner")
    my-bottom-bar.bottom(:click="save")
        .g-bottom-btn 提交
</template>
<script>
export default {
    data() {
        return {
            form: {
                business: '',
                examiner: '',
                owner: ''
            }
        };
    },
    methods: {
        async getInfo() {
            try {
                let { data } = await this.$http.post('/mobile/product/info', {
                    id: this.$route.query.id
                });
                this.form = data;
            } catch (error) {
                console.log(error);
            }
        },
        async save() {
            try {
                await this.$http.post('/mobile/product/infosave', {
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
    mounted() {
        this.getInfo();
    }
};
</script>
