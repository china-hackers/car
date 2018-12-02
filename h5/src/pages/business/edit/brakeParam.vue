<template lang="pug">
.page
    my-nav-bar(title="车轮制动")
    van-cell-group
        my-form-select(label="前制动" placeholder="请选择" v-model="form.head_drive" :actions="brake")
        my-form-select(label="后制动" placeholder="请选择" v-model="form.back_drive" :actions="brake")
        van-field(label="前轮规格" placeholder="xx/xxRxx" v-model="form.head_std")
        van-field(label="后轮规格" placeholder="xx/xxRxx" v-model="form.back_std")
    my-bottom-bar.bottom(:click="save")
        .g-bottom-btn 提交
</template>

<script>
import carEditMixin from '../mixins/carEdit';
export default {
    mixins: [carEditMixin],
    data() {
        return {
            form: {
                head_drive: '',
                back_drive: '',
                head_std: '',
                back_std: ''
            }
        };
    },
    methods: {
        async save() {
            try {
                await this.$http.post('/mobile/product/tyresave', {
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
    async created() {
        try {
            let { data } = await this.$http.post('/mobile/product/tyre', {
                id: this.$route.query.id
            });
            this.form = {
                head_drive: data['head_drive'],
                back_drive: data['back_drive'],
                head_std: data['head_std'],
                back_std: data['back_std']
            };
        } catch (error) {
            console.log(error);
        }
    }
};
</script>
