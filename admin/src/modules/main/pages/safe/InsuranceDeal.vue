<template lang="pug">
.page-employee
    my-page-title(title="I品车险已成交")
    .bar
        el-form(:inline="true" @click.native.prevent="")
            el-form-item
                el-input(placeholder="请输入姓名" v-model="name")
            el-form-item
                my-button(type="primary" :loading="loading" :click="research") 搜索
    .content(v-loading="loading")
        el-table(:data="list" border style="width: 100%")
            el-table-column(align="center" type="index")
            el-table-column(align="center" label="成交姓名" prop="d_name")
            el-table-column(align="center" label="成交电话" prop="d_phone")
            el-table-column(align="center" label="成交车牌号" prop="d_car_no")
            el-table-column(align="center" label="交强险到期时间" prop="d_j_outdate")
            el-table-column(align="center" label="商业险到期时间" prop="d_s_outdate")
            el-table-column(align="center" label="车险总价(元)" prop="d_price")
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
    my-note-editor(ref="my-note-editor" list-url="/mobile/finance/safelogs" add-url="/admin/finance/safelog" post-key="sid")
    status-editor(ref="status-editor" ftype="safe" @change="getList")
    insurance-dealer(ref="dealer-editor" @success="getList")
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
        formatDate (date) {
            return formatDate(date);
        },
        async getList () {
            try {
                let { data } = await this.$http.post('/admin/finance/safelist', {
                    p: this.pagination.curPage,
                    name: this.name,
                    state: 4
                });
                this.list = data.data.list;
                this.pagination.pageTotal = data.data.total;
            } catch (error) {
                console.log(error);
            }
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
    .content {
        img {
            display: block;
            width: 100%;
        }
    }
}
</style>
