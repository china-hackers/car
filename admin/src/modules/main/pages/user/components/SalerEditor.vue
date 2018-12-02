<template lang="pug">
el-dialog(title="修改销售信息" :visible.sync="visible" width="800px")
    el-form(label-width="120px" label-position="left")
            el-form-item(label="销售姓名")
                el-input(v-model="form.name")
            el-form-item(label="电话")
                el-input(v-model="form.phone")
            el-form-item(label="城市")
                el-input(v-model="form.city" disabled)
            el-form-item(label="身份证号")
                el-input(v-model="form.id_card")
            el-form-item(label="性别")
                el-radio-group(v-model="form.sex")
                    el-radio(label="男") 男
                    el-radio(label="女") 女
            el-form-item(label="")
                my-button(type="primary" :click="save") 保存
</template>

<script>
import dialogMixin from '@/mixins/dialog';
import pageMixin from '@/mixins/page';
export default {
    mixins: [pageMixin, dialogMixin],
    data() {
        return {
            form: {
                city: '',
                id_card: '',
                name: '',
                phone: '',
                sex: '',
                uid: 1
            }
        };
    },
    methods: {
        setData(data) {
            this.form = {
                name: data.name,
                phone: data.phone,
                id_card: data.id_card,
                sex: data.sex,
                city: data.city || '成都',
                id: data.uid
            };
            console.log(data);
        },
        async save() {
            try {
                await this.$http.post('/admin/user/save', this.form);
                this.success('修改成功');
                this.$emit('success');
                this.close();
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>
