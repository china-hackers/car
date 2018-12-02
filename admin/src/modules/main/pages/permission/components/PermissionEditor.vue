<template lang="pug">
el-dialog(title="新增权限" :visible.sync="visible" width="800px")
    .comp-employee-editor
        el-form(label-width="120px" label-position="left")
            el-form-item(label="权限名")
                el-input(v-model="form.title")
            el-form-item(label="父级")
                el-select.form-item-1(v-model="form.pid")
                    el-option(label="无" :value="0")
                    el-option(v-for="permission in parentList" :label="permission.title" :value="permission.id" :key="permission.id")
            el-form-item(label="路由地址")
                el-input(v-model="form.route")
            el-form-item(label="icon的class")
                el-input(v-model="form.icon")
            el-form-item(label="菜单排序")
                el-input-number(v-model="form.orders" :min="0" :precision="0" :step="1")
            el-form-item(label="是否为菜单")
                el-radio-group(v-model="form.is_menu")
                    el-radio(:label="1") 是
                    el-radio(:label="0") 否
            el-form-item(label="")
                my-button(:click="save") 保存
</template>

<script>
import dialogMixin from '@/mixins/dialog';
export default {
    mixins: [dialogMixin],
    data() {
        return {
            form: {
                id: '',
                title: '',
                route: '',
                icon: '',
                pid: 0,
                orders: 0,
                is_menu: 0
            },
            parentList: [],
            saveing: false
        };
    },
    methods: {
        async setDefaultValues() {
            if (this.type === 'edit') {
                try {
                    let { data } = await this.$http.post(
                        '/admin/permission/permission',
                        {
                            id: this.form.id
                        }
                    );
                    Object.assign(this.form, data.data);
                } catch (error) {
                    console.log(error);
                }
            } else {
                Object.assign(this.form, {
                    id: '',
                    title: '',
                    route: '',
                    icon: '',
                    pid: 0,
                    orders: 0,
                    is_menu: 0
                });
            }
        },
        async getParentList() {
            try {
                let { data } = await this.$http.post(
                    '/admin/permission/parentlist',
                    {
                        p: 1
                    }
                );
                this.parentList = data.data.list;
            } catch (error) {
                console.log(error);
            }
        },
        async save() {
            try {
                if (this.type === 'new') {
                    await this.$http.post('/admin/permission/add', {
                        ...this.form
                    });
                    this.success('添加成功');
                } else {
                    await this.$http.post('/admin/permission/edit', {
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
    mounted() {
        this.getParentList();
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
