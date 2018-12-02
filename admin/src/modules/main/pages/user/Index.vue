<template lang="pug">
.page-uer-index
    my-page-title(title="用户管理")
    .bar
        el-form(:inline="true" @click.native.prevent="")
            el-form-item
                el-input(placeholder="请输入姓名" v-model="name")
            el-form-item
                my-button(type="primary" :loading="loading" :click="research") 搜索
    .content(v-loading="loading")
        el-table(:data="list" border style="width: 100%")
            el-table-column(align="center" type="index")
            el-table-column(align="center" label="微信名" prop="nickname")
            el-table-column(align="center" label="电话" prop="phone")
        .pager
            el-pagination(:page-sizes="[20]"
                layout="total,slot,prev,pager,next"
                :current-page.sync="pagination.curPage"
                :page-size="pagination.pageSize"
                :total="pagination.pageTotal"
                @current-change="pageCurPageChange"
                @size-change="pageSizeChange")
    my-note-editor(ref="my-note-editor" list-url="/mobile/finance/loanlogs" add-url="/admin/finance/loanlog" post-key="lid")
</template>

<script>
import pageMixin from '@/mixins/page';
import { formatDate } from '@/lib/util';
export default {
    mixins: [pageMixin],
    data() {
        return {
            list: [],
            name: '',
            loading: false
        };
    },
    methods: {
        viewNotes(item) {
            let comp = this.$refs['my-note-editor'];
            comp.setId(item.id);
            comp.open();
        },
        research() {
            this.pagination.curPage = 1;
            this.list = [];
            this.getList();
        },
        async getList() {
            try {
                let { data } = await this.$http.post('/admin/user/list', {
                    p: this.pagination.curPage,
                    name: this.name
                });
                this.list = data.data.list;
                this.pagination.pageTotal = data.data.total;
            } catch (error) {
                console.log(error);
            }
        },
        formatDate(date) {
            return formatDate(date);
        }
    },
    created() {
        this.getList();
    }
};
</script>

<style lang="scss" scoped>
.page-user-index {
    .bar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }
}
</style>
