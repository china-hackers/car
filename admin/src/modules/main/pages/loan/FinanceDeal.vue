<template lang="pug">
.page-employee
    my-page-title(title="I品金融已成交")
    .bar
        el-form(:inline="true" @click.native.prevent="")
            el-form-item
                el-input(placeholder="请输入姓名" v-model="name")
            el-form-item
                my-button(type="primary" :loading="loading" :click="research") 搜索
    .content(v-loading="loading")
        el-table(:data="list" border style="width: 100%")
            el-table-column(align="center" type="index")
            el-table-column(align="center" label="成交借款人姓名" prop="d_name")
            el-table-column(align="center" label="成交借款人电话" prop="d_phone")
            el-table-column(align="center" label="成交贷款类型" prop="d_type")
            el-table-column(align="center" label="贷款总额(元)" prop="d_money")
            el-table-column(align="center" label="实际还款总额(元)" prop="d_money_return")
            el-table-column(align="center" label="最终贷款时间(月数)" prop="d_month")
            el-table-column(align="center" label="每月还款金额(元)" prop="d_pay")
            el-table-column(align="center" label="首次还款时间" prop="d_date")
            el-table-column(align="center" label="操作" prop="")
                template(slot-scope="scope")
                    el-button(type="text" @click="viewNotes(scope.row)") 备注
                    el-button(type="text" @click="changeStatus(scope)" v-if="scope.row.state!==4") 修改状态
                    el-button(type="text" @click="deal(scope.row)") 修改
        .pager
            el-pagination(:page-sizes="[20]"
                layout="total,slot,prev,pager,next"
                :current-page.sync="pagination.curPage"
                :page-size="pagination.pageSize"
                :total="pagination.pageTotal"
                @current-change="pageCurPageChange"
                @size-change="pageSizeChange")
    my-note-editor(ref="my-note-editor" list-url="/mobile/finance/loanlogs" add-url="/admin/finance/loanlog" post-key="lid")
    status-editor(ref="status-editor" ftype="loan" @change="getList")
    finance-dealer(ref="dealer-editor" @success="getList")
</template>

<script>
import pageMixin from '@/mixins/page';
import commonMixin from '../../mixins/common';
import { formatDate } from '@/lib/util';
export default {
    mixins: [pageMixin, commonMixin],
    data () {
        return {
            list: [],
            name: '',
            loading: false
        };
    },
    methods: {
        viewNotes (item) {
            let comp = this.$refs['my-note-editor'];
            comp.setId(item.id);
            comp.open();
        },
        research () {
            this.pagination.curPage = 1;
            this.list = [];
            this.getList();
        },
        async getList () {
            try {
                let { data } = await this.$http.post('/admin/finance/loanlist', {
                    p: this.pagination.curPage,
                    name: this.name,
                    state: 4
                });
                this.list = data.data.list;
                this.pagination.pageTotal = data.data.total;
            } catch (error) {
                console.log(error);
            }
        },
        formatDate (date) {
            return formatDate(date);
        }

    },
    created () {
        this.getList();
    }
};
</script>

<style lang="scss" scoped>
.page-employee {
    .bar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }
}
</style>
