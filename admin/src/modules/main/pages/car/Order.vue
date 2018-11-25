<template lang="pug">
.page-car-rent
    my-page-title(title="I品车订单")
    .bar
        el-form(:inline="true" @click.native.prevent="")
            el-form-item
                el-input(placeholder="请输入搜索信息" v-model="name")
            el-form-item
                my-button(type="primary" :loading="loading" :click="research") 搜索
    .content(v-loading="loading")
        el-table(:data="list" border style="width: 100%")
            el-table-column(align="center" type="index")
            el-table-column(align="center" label="意向车辆" prop="pid")
            el-table-column(align="center" label="姓名" prop="name")
            el-table-column(align="center" label="电话" prop="phone")
            el-table-column(align="center" label="填表时间" prop="created")
                template(slot-scope="scope") {{formatDate(new Date(scope.row.created*1000))}}
            el-table-column(align="center" label="指定销售" prop="saler_id")
            el-table-column(align="center" label="是否成交" prop="")
                template(slot-scope="scope") {{scope.row.is_deal===1?'已成交':'未成交'}}
            el-table-column(align="center" label="成交车辆" prop="")
            el-table-column(align="center" label="成交金额" prop="price")
            el-table-column(align="center" label="操作" prop="")
                template(slot-scope="scope")
                    el-button(type="text" @click="viewNotes(scope.row)") 备注
                    el-button(type="text" @click="jumpToCarDetail(scope.row)") 车辆信息
                    el-button(type="text" @click="appoint(scope.row)" v-if="scope.row.is_deal!==1") 分配销售
                    //- el-button(type="text" v-if="scope.row.is_deal===0" @click="deal(scope.row)") 成交

        .pager
            el-pagination(:page-sizes="[20]"
                layout="total,slot,prev,pager,next"
                :current-page.sync="pagination.curPage"
                :page-size="pagination.pageSize"
                :total="pagination.pageTotal"
                @current-change="pageCurPageChange"
                @size-change="pageSizeChange")
    my-note-editor(ref="my-note-editor" list-url="/mobile/finance/buylogs" add-url="/admin/finance/buylog" post-key="bid")
</template>

<script>
import pageMixin from '@/mixins/page';
import { formatDate } from '@/lib/util';
export default {
    mixins: [pageMixin],
    data () {
        return {
            list: [],
            name: '',
            loading: false
        };
    },
    methods: {
        getState (state) {
            return {
                0: '已上架',
                1: '已下架',
                2: '已售'
            };
        },
        jumpToCarDetail (data) {
            this.$router.push({
                path: '/car/edit',
                query: {
                    id: data.pid
                }
            });
        },
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
                let { data } = await this.$http.post('/admin/finance/buylist', {
                    p: this.pagination.curPage,
                    name: this.name
                });
                this.list = data.data.list;
                this.pagination.pageTotal = data.data.total;
                this.$store.commit('UPDATE_ORIGIN_BUY');
            } catch (error) {
                console.log(error);
            }
        },
        formatDate (date) {
            return formatDate(date);
        },
        async deal (item) {
            try {
                await this.$confirm('确认提交');
                await this.$http.post('/admin/finance/buycheck', {
                    id: item.id
                });
                this.success('提交成功');
                this.getList();
            } catch (error) {
                console.log(error);
            }
        },
        // 分配销售
        async appoint (data) {
            try {
                await this.$http.post('/admin/finance/saler2user', {
                    id: data.id
                });
                this.success('分配成功');
                this.getList();
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
.page-car-rent {
    .bar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }
}
</style>
