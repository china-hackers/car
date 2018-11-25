<template lang="pug">
.page
    my-nav-bar(title="底盘参数")
    van-cell-group
        my-form-select(label="驱动方式" placeholder="请选择" v-model="form.dirve_type" :actions="drivingModel")
        my-form-select(label="转向系统" placeholder="请选择" v-model="form.turn_sys" :actions="steeringSystem")
        my-form-select(label="前悬挂" placeholder="请选择" v-model="form.head_sys" :actions="suspensionSystem")
        my-form-select(label="后悬挂" placeholder="请选择" v-model="form.back_sys" :actions="suspensionSystem")
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
                dirve_type: '',
                turn_sys: '',
                head_sys: '',
                back_sys: ''
            }
        };
    },
    methods: {
        async save () {
            try {
                await this.$http.post('/mobile/product/undersave', {
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
            let { data } = await this.$http.post('/mobile/product/under', {
                id: this.$route.query.id
            });
            this.form = {
                dirve_type: data['dirve_type'],
                turn_sys: data['turn_sys'],
                head_sys: data['head_sys'],
                back_sys: data['back_sys']
            };
        } catch (error) {
            console.log(error);
        }
    }
};
</script>
