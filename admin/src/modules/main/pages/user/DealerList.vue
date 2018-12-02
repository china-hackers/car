<template lang="pug">
.page-car-dealer
    my-page-title(title="车商管理")
    .bar
        el-form(:inline="true" @click.native.prevent="")
            el-form-item(label="姓名：")
                el-input(placeholder="请输入车商姓名" v-model="filter.name" @change="research")
            el-form-item(label="审核：")
                el-select(v-model="filter.check" @change="research")
                    el-option(label="全部" value="")
                    el-option(label="未审核" :value="0")
                    el-option(label="已审核" :value="1")
            el-form-item
                my-button(:click="research") 搜索
    .content
        el-table(:data="list" border style="width: 100%")
            el-table-column(align="center" type="index")
            el-table-column(align="center" label="车行名称" prop="name")
            el-table-column(align="center" label="电话号码" prop="phone")
            el-table-column(align="center" label="地址" prop="address")
            el-table-column(align="center" label="管理员姓名" prop="uname")
            el-table-column(align="center" label="管理员电话" prop="uphone")
            el-table-column(align="center" label="管理员城市" prop="ucity")
            el-table-column(align="center" label="管理员性别" prop="usex")
            el-table-column(align="center" label="管理员身份证" prop="ucard")
            el-table-column(align="center" label="是否审核" prop="is_checked")
                template(slot-scope="scope") {{scope.row.is_checked===1?'是':'否'}}
            el-table-column(align="center" label="操作")
                template(slot-scope="scope")
                    el-button(type="text" @click="verify(scope.row)" v-if="scope.row.is_checked===0") 审核通过
                    el-button(type="text" @click="reject(scope.row)" v-if="scope.row.is_checked===0") 删除
                    el-button(type="text" @click="viewDetail(scope.row)" v-else) 查看销售员
                    el-button(type="text" @click="edit(scope.row)") 修改信息

    .pager
        el-pagination(
            layout="total,slot,prev,pager,next"
            :current-page.sync="pagination.curPage"
            :page-size="pagination.pageSize"
            :total="pagination.pageTotal"
            @current-change="pageCurPageChange"
            @size-change="pageSizeChange")
    dealer-verify(ref="dealer-verify" @change="req")
    dealer-editor(ref="dealer-editor" @success="req")
</template>

<script>
import DealerVerify from './components/DealerVerify';
import DealerEditor from './components/DealerEditor';
import pageMixin from '@/mixins/page';
export default {
    mixins: [pageMixin],
    data() {
        return {
            filter: {
                name: '',
                check: ''
            },
            list: []
        };
    },
    components: {
        // 'my-car-dealer-editor': CarDealerEditor
        'dealer-verify': DealerVerify,
        DealerEditor
    },
    methods: {
        async verify(item) {
            try {
                // let comp = this.$refs['dealer-verify'];
                // comp.setDealerInfo(item);
                // comp.open();
                await this.$confirm('确认审核通过吗？');
                await this.$http.post('/admin/business/check', {
                    bid: item.id,
                    check: 1
                });
                this.success('审核成功');
                this.req();
            } catch (error) {
                console.log(error);
            }
        },
        async edit(data) {
            let comp = this.$refs['dealer-editor'];
            comp.setData(data);
            comp.open();
        },
        async reject(item) {
            try {
                await this.$confirm('确认删除吗？');
                await this.$http.post('/admin/business/check', {
                    bid: item.id,
                    check: 0
                });
                this.success('审核成功');
                this.req();
            } catch (error) {
                console.log(error);
            }
        },
        viewDetail(item) {
            this.$router.push({
                path: '/user/dealer-detail',
                query: {
                    id: item.id
                }
            });
        },
        async req() {
            try {
                let params = {
                    p: this.pagination.curPage,
                    ...this.filter
                };
                let { data } = await this.$http.post(
                    '/admin/business/list',
                    params
                );
                this.dealData(data.data);
            } catch (error) {
                console.log(error);
            }
        }
    },
    created() {
        this.req();
    }
};
</script>

<style lang="scss" scoped>
.page-car-dealer {
    .bar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }
    .img {
        width: 40px;
        height: 40px;
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
    }
}
</style>
