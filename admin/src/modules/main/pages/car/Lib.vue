<template lang="pug">
.page-second-hand-car
    my-page-title(title="I品二手车")
    my-car-filter(@new-car="newCar" @start-search="startSearch")
    .content(v-loading="loading")
        el-table(:data="list" border style="width: 100%")
            el-table-column(align="center" type="index")
            el-table-column(align="center" label="车行名称" prop="business_name")
            el-table-column(align="center" label="标题" prop="title")
            el-table-column(align="center" label="卖价(万)" prop="price")
            el-table-column(align="center" label="新车价(万)" prop="price_new")
            el-table-column(align="center" label="上牌时间" prop="reg_date")
            el-table-column(align="center" label="行驶里程(km)" prop="km")
            el-table-column(align="center" label="归属地" prop="city")
            el-table-column(align="center" label="状态" prop="state")
                template(slot-scope="scope") {{getState(scope.row.state)}}
            el-table-column(align="center" label="链接" prop="")
                template(slot-scope="scope") {{`/car/detail?id=${scope.row.id}`}}
            el-table-column(align="center" label="操作" prop="")
                template(slot-scope="scope" v-if="scope.row.state!==2")
                    el-button(type="text" @click="jumpToEdit(scope.row)") 修改
                    el-button(type="text" @click="pass(scope.row)" v-if="scope.row.state!==0") 审核
                    el-button(type="text" @click="unpass(scope.row)" v-if="scope.row.state===0") 下架
                    el-button(type="text" @click="del(scope.row)") 删除
        .pager
            el-pagination(:page-sizes="[20]"
                layout="total,slot,prev,pager,next"
                :current-page.sync="pagination.curPage"
                :page-size="pagination.pageSize"
                :total="pagination.pageTotal"
                @current-change="pageCurPageChange"
                @size-change="pageSizeChange")
</template>

<script>
import pageMixin from '@/mixins/page';
import CarFilter from '../../components/CarFilter';
export default {
    mixins: [pageMixin],
    data () {
        return {
            list: [],
            loading: false,
            filter: {}
        };
    },
    components: {
        'my-car-filter': CarFilter
    },
    methods: {
        getState (state) {
            return {
                0: '已上架',
                1: '已下架',
                2: '已售'
            }[state];
        },
        newCar () {
            this.$router.push({
                path: '/car/add'
            });
        },
        startSearch (data) {
            this.pagination.curPage = 1;
            this.filter = data;
            this.req();
        },
        async req () {
            try {
                let { data } = await this.$http.post('/admin/product/list', {
                    p: this.pagination.curPage,
                    ...this.filter
                });
                this.list = data.data.list;
                this.pagination.pageTotal = data.data.total;
            } catch (error) {
                console.log(error);
            }
        },
        jumpToEdit (item) {
            this.$router.push({
                path: '/car/edit',
                query: {
                    id: item.id
                }
            });
        },
        async pass (item) {
            try {
                await this.$confirm('确认审核通过该车辆');
                await this.$http.post('/admin/product/check', {
                    id: item.id
                });
                this.success('审核成功');
                this.req();
            } catch (error) {
                console.log(error);
            }
        },
        async unpass (item) {
            try {
                await this.$confirm('确认下架该车辆');
                await this.$http.post('/admin/product/close', {
                    id: item.id
                });
                this.success('下架成功');
                this.req();
            } catch (error) {
                console.log(error);
            }
        },
        async del (item) {
            try {
                await this.$confirm('确认删除该车辆');
                await this.$http.post('/admin/product/delete', {
                    id: item.id
                });
                this.success('删除成功');
                this.req();
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.page-second-hand-car {
    .bar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }
}
</style>
