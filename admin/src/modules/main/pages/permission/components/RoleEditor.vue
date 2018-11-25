<template lang="pug">
el-dialog(title="新增角色" :visible.sync="visible" width="800px")
    .comp-employee-editor
        el-form(label-width="80px" label-position="left")
            el-form-item(label="角色名")
                el-input(v-model="form.role")
            el-form-item(label="备注")
                el-input(v-model="form.note")
            el-form-item(label="权限")
                el-tree(:data="checkList" show-checkbox :props="{label:'title'}" node-key="id" ref="tree" @check-change="handleCheckChange")
            el-form-item(label="")
                my-button(:click="save") 保存
</template>

<script>
import dialogMixin from '@/mixins/dialog';
import MyButton from '@/components/MyButton';
export default {
    mixins: [dialogMixin],
    components: {
        'my-button': MyButton
    },
    data () {
        return {
            form: {
                id: '',
                role: '',
                note: '',
                permission: []
            },
            checkList: []
        };
    },
    methods: {
        handleCheckChange () {
            this.form.permission = this.$refs.tree.getCheckedKeys();
        },
        clear () {
            this.form = {
                id: '',
                role: '',
                note: '',
                permission: []
            };
        },
        async setDefaultValues () {
            if (this.type === 'edit') {
                try {
                    let { data } = await this.$http.post('/admin/role/role', {
                        id: this.form.id
                    });
                    Object.assign(this.form, data.data);
                    this.$refs.tree.setCheckedKeys(this.form.permission);
                } catch (error) {
                    console.log(error);
                }
            } else {
                Object.assign(this.form, {
                    id: '',
                    role: '',
                    note: '',
                    permission: []
                });
            }
        },
        async getAllPermissions () {
            try {
                let { data } = await this.$http.post('/admin/permission/checklist', {
                    p: 1
                });
                this.checkList = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        async save () {
            try {
                if (this.type === 'new') {
                    await this.$http.post('/admin/role/add', {
                        ...this.form
                    });
                    this.success('添加成功');
                } else {
                    await this.$http.post('/admin/role/edit', {
                        ...this.form
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
        this.getAllPermissions();
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
