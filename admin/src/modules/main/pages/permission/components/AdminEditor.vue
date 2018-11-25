<template lang="pug">
el-dialog(:title="`${titleText}管理员`" :visible.sync="visible" width="800px")
    .comp-employee-editor
        el-form(label-width="80px" label-position="left")
            el-form-item(label="用户名")
                el-input(v-model="form.admin")
            el-form-item(label="密码" v-if="type==='new'")
                el-input(v-model="form.pswd")
            el-form-item(label="真实姓名")
                el-input(v-model="form.name")
            el-form-item(label="角色")
                el-select.form-item-1(v-model="form.role_id")
                    el-option(v-for="role in roleList" :label="role.role" :value="role.id" :key="role.id")
            el-form-item(label="性别")
                el-radio-group(v-model="form.sex")
                    el-radio(label="男") 男
                    el-radio(label="女") 女
            el-form-item(label="手机号码")
                el-input(v-model="form.phone" type="tel")
            el-form-item(label="")
                my-button(:click="saveAdmin") 保存
</template>

<script>
import dialogMixin from '@/mixins/dialog';
export default {
    mixins: [dialogMixin],
    components: {
    },
    data () {
        return {
            form: {
                id: '',
                admin: '',
                pswd: '123456',
                role_id: '',
                sex: '男',
                name: '',
                phone: ''
            },
            roleList: []
        };
    },
    methods: {
        async setDefaultValues () {
            if (this.type === 'edit') {
                try {
                    let { data } = await this.$http.post('/admin/admin/admin', {
                        id: this.form.id
                    });
                    data.data.pswd = '';
                    Object.assign(this.form, data.data);
                } catch (error) {
                    console.log(error);
                }
            } else {
                Object.assign(this.form, {
                    id: '',
                    admin: '',
                    pswd: '123456',
                    role_id: '',
                    sex: '男',
                    name: '',
                    phone: ''
                });
            }
        },
        async getRoles () {
            try {
                let { data } = await this.$http.post('/admin/role/list', {
                    p: 1
                });

                this.roleList = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        async saveAdmin () {
            try {
                if (this.type === 'new') {
                    await this.$http.post('/admin/admin/add', {
                        ...this.form
                    });
                    this.success('添加成功');
                } else {
                    let params = Object.assign({}, this.form);
                    delete params.pswd;
                    await this.$http.post('/admin/admin/edit', {
                        ...params
                    });
                    this.success('修改成功');
                }
                this.$emit('save-success');
                this.close();
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted () {
        this.getRoles();
    }
};
</script>

<style lang="scss" scoped>
.comp-employee-editor {
    width: 500px;
    padding-left: 40px;
    .el-checkbox {
        margin-left: 0;
        margin-right: 30px;
        &:last-child {
            margin-right: 0;
        }
    }
}
</style>
