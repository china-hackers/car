<template lang="pug">
.page-permission-admin
    my-page-title(title="管理员列表")
    .bar
        el-form(:inline="true" @click.native.prevent="")
            el-form-item
                el-input(placeholder="请输入管理员姓名")
            el-form-item
                my-button(type="primary" :loading="loading") 搜索
        el-button(type="primary" @click="addEmployee") 新增管理员
    .content(v-loading="loading")
        el-table(:data="list" border style="width: 100%")
            el-table-column(align="center" type="index")
            el-table-column(align="center" label="用户名" prop="admin")
            el-table-column(align="center" label="真实名称" prop="name")
            el-table-column(align="center" label="角色" prop="role_name")
            el-table-column(align="center" label="性别" prop="sex")
            el-table-column(align="center" label="手机号码" prop="phone")
            el-table-column(align="center" label="操作" prop="")
                template(slot-scope="scope")
                    el-button(type="text" @click="editAdmin(scope.row)") 修改
                    el-button(type="text" @click="resetPswd(scope.row)") 重置密码
                    el-button(type="text" @click="deleteAdmin(scope.row)") 删除
        .pager
            el-pagination(
                layout="total,slot,prev,pager,next"
                :current-page.sync="pagination.curPage"
                :page-size="pagination.pageSize"
                :total="pagination.pageTotal"
                @current-change="pageCurPageChange"
                @size-change="pageSizeChange")
    my-admin-editor(ref="my-admin-editor" @save-success="req")
</template>

<script>
import AdminEditor from './components/AdminEditor';
import pageMixin from '@/mixins/page';
export default {
    mixins: [pageMixin],
    data() {
        return {
            list: [],
            loading: false
        };
    },
    components: {
        'my-admin-editor': AdminEditor
    },
    methods: {
        addEmployee() {
            let comp = this.$refs['my-admin-editor'];
            comp.setEditorType('new');
            comp.open();
        },
        async req() {
            try {
                let { data } = await this.$http.post(`/admin/admin/list`, {
                    p: this.pagination.curPage
                });
                this.list = data.data.list;
                this.pagination.pageTotal = data.data.total;
                console.log(data);
            } catch (error) {
                console.log(error);
            }
        },
        async deleteAdmin(admin) {
            try {
                await this.$http.post('/admin/admin/delete', {
                    id: admin.id
                });
                this.success('删除成功');
                this.req();
            } catch (error) {
                console.log(error);
            }
        },
        async resetPswd(admin) {
            try {
                await this.$http.post('/admin/admin/reset', {
                    id: admin.id
                });
                this.success('设置成功');
                this.req();
            } catch (error) {
                console.log(error);
            }
        },
        editAdmin(admin) {
            let comp = this.$refs['my-admin-editor'];
            comp.setId(admin.id);
            comp.open();
        }
    },
    mounted() {
        this.req();
    }
};
</script>

<style lang="scss" scoped>
.page-permission-admin {
    .bar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }
}
</style>
