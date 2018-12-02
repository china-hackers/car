<template lang="pug">
.page-permission
    my-page-title(title="权限列表")
    my-common-bar(:formDisplay="false" newBtnText="新增权限" @new="addPermission")
    .content(v-loading="loading")
        el-table(:data="list" border style="width: 100%")
            el-table-column(align="center" type="index")
            el-table-column(align="center" label="菜单名/权限名" prop="title")
            el-table-column(align="center" label="父级菜单" prop="pid")
            el-table-column(align="center" label="路由" prop="route")
            el-table-column(align="center" label="是否是菜单" prop="is_menu")
                template(slot-scope="scope")
                    | {{ scope.row.is_menu===0?'否':'是'}}
            el-table-column(align="center" label="排序" prop="orders")
            el-table-column(align="center" label="ICON" prop="icon")
            el-table-column(align="center" label="操作" prop="")
                template(slot-scope="scope")
                    el-button(type="text" @click="edit(scope.row)") 编辑
                    el-button(type="text" @click="deletePermission(scope.row)") 删除
    .pager
        el-pagination(
            layout="total,slot,prev,pager,next"
            :current-page.sync="pagination.curPage"
            :page-size="pagination.pageSize"
            :total="pagination.pageTotal"
            @current-change="pageCurPageChange"
            @size-change="pageSizeChange")
    my-permission-editor(ref="my-permission-editor" @save-success="req")
</template>

<script>
import PermissionEditor from './components/PermissionEditor';
import pageMixin from '@/mixins/page';
export default {
    mixins: [pageMixin],
    data() {
        return {
            list: [{}],
            loading: false
        };
    },
    components: {
        'my-permission-editor': PermissionEditor
    },
    methods: {
        addPermission() {
            let comp = this.$refs['my-permission-editor'];
            comp.setEditorType('new');
            comp.open();
        },
        async req() {
            try {
                let { data } = await this.$http.post('/admin/permission/list', {
                    p: this.pagination.curPage
                });
                this.list = data.data.list;
                this.pagination.pageTotal = data.data.total;
            } catch (error) {
                console.log(error);
            }
        },
        edit(permission) {
            let comp = this.$refs['my-permission-editor'];
            comp.setId(permission.id);
            comp.open();
        },
        async deletePermission(permission) {
            try {
                await this.$http.post('/admin/permission/delete', {
                    id: permission.id
                });
                this.success('删除成功');
                this.req();
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.req();
    }
};
</script>
