<template lang="pug">
.page-permission-role
    my-page-title(title="角色列表")
    my-common-bar(:formDisplay="false" newBtnText="新增角色" @new="addRole")
    .content(v-loading="loading")
        el-table(:data="list" border style="width: 100%")
            el-table-column(align="center" type="index")
            el-table-column(align="center" label="角色名" prop="role")
            el-table-column(align="center" label="操作" prop="")
                template(slot-scope="scope")
                    el-button(type="text" @click="edit(scope.row)") 编辑
                    el-button(type="text" @click="deleteRole(scope.row)") 删除
    .pager
        el-pagination(
            layout="total,slot,prev,pager,next"
            :current-page.sync="pagination.curPage"
            :page-size="pagination.pageSize"
            :total="pagination.pageTotal"
            @current-change="pageCurPageChange"
            @size-change="pageSizeChange")
    my-role-editor(ref="my-role-editor" @save-success="req")
</template>

<script>
import RoleEditor from './components/RoleEditor';
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
        'my-role-editor': RoleEditor
    },
    methods: {
        addRole() {
            let comp = this.$refs['my-role-editor'];
            comp.setEditorType('new');
            comp.open();
        },
        async req() {
            try {
                let { data } = await this.$http.post('/admin/role/list', {
                    p: this.pagination.curPage
                });
                this.list = data.data.list;
                this.pagination.pageTotal = data.data.total;
            } catch (error) {
                console.log(error);
            }
        },
        edit(role) {
            let comp = this.$refs['my-role-editor'];
            comp.setId(role.id);
            comp.open();
        },
        async deleteRole(role) {
            try {
                await this.$http.post('/admin/role/delete', {
                    id: role.id
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

<style lang="scss" scoped>
.page-permission-admin {
    .bar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }
}
</style>
