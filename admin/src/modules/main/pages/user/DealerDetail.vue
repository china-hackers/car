<template lang="pug">
.page-car-dealer
    my-page-title(title="车商销售列表")
    .bar
        el-form(:inline="true" @click.native.prevent="")
            el-form-item()
                el-button(type="primary" @click="back") 返回车商列表
    .content
        el-table(:data="list" border style="width: 100%")
            el-table-column(align="center" type="index")
            el-table-column(align="center" label="姓名" prop="name")
            el-table-column(align="center" label="电话号码" prop="phone")
            el-table-column(align="center" label="性别" prop="sex")
            el-table-column(align="center" label="城市" prop="sex")
            el-table-column(align="center" label="身份证" prop="sex")
            //- el-table-column(align="center" label="是否审核" prop="is_checked")
            //-     template(slot-scope="scope") {{scope.row.is_checked==1?'是':'否'}}
            el-table-column(align="center" label="管理员" prop="is_manager")
                template(slot-scope="scope") {{scope.row.is_manager==1?'是':'否'}}
            el-table-column(align="center" label="操作")
                template(slot-scope="scope")
                    el-button(type="primary" size="small" @click="deleteItem(scope.row)" v-if="scope.row.is_manager==0") 删除
                    el-button(type="text" @click="edit(scope.row)") 修改信息
    .pager
        el-pagination(
            layout="total,slot,prev,pager,next"
            :current-page.sync="pagination.curPage"
            :page-size="pagination.pageSize"
            :total="pagination.pageTotal"
            @current-change="pageCurPageChange"
            @size-change="pageSizeChange")
    saler-editor(ref="saler-editor" @success="req")

</template>

<script>
import pageMixin from '@/mixins/page';
import SalerEditor from './components/SalerEditor.vue';
export default {
    mixins: [pageMixin],
    components: { SalerEditor },
    data() {
        return {
            filter: {
                name: '',
                check: ''
            },
            list: []
        };
    },
    methods: {
        back() {
            history.back();
        },
        edit(data) {
            let comp = this.$refs['saler-editor'];
            comp.setData(data);
            comp.open();
        },
        async deleteItem(data) {
            try {
                await this.$confirm('确认删除吗？');
                await this.$http.post('/admin/business/salerdelete', {
                    uid: data.uid
                });
                this.success('删除成功');
                this.req();
            } catch (error) {
                console.log(error);
            }
        },
        async req() {
            try {
                let params = {
                    p: 1,
                    bid: this.$route.query.id
                };
                let { data } = await this.$http.post(
                    '/admin/business/salers',
                    params
                );
                console.log(data);
                this.list = data.data;
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
