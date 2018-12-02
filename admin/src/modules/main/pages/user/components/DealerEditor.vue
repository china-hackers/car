<template lang="pug">
el-dialog(title="修改销售信息" :visible.sync="visible" width="800px")
    el-form(label-width="120px" label-position="left")
            el-form-item(label="车行名称")
                el-input(v-model="form.name")
            el-form-item(label="车行电话")
                el-input(v-model="form.phone")
            el-form-item(label="地址")
                el-input(v-model="form.address" )
            el-form-item(label="管理员姓名")
                el-input(v-model="form.uname")
            el-form-item(label="管理员电话")
                el-input(v-model="form.uphone")
            el-form-item(label="管理员城市")
                el-input(v-model="form.ucity" disabled)
            el-form-item(label="管理员身份证")
                el-input(v-model="form.ucard")
            el-form-item(label="管理员性别")
                el-radio-group(v-model="form.usex")
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
            form: {}
        };
    },
    methods: {
        setData(data) {
            this.form = {
                address: data.address,
                name: data.name,
                phone: data.phone,
                ucard: data.ucard,
                ucity: data.ucity || '成都',
                uname: data.uname,
                uphone: data.uphone,
                usex: data.usex,
                id: data.id
            };
        },
        async save() {
            try {
                await this.$http.post('/admin/business/save', this.form);
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
