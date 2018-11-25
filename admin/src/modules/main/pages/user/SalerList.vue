<template lang="pug">
.page
    my-page-title(title="I品车销售")
    el-table(:data="list" border style="width: 100%")
        el-table-column(align="center" type="index")
        el-table-column(align="center" label="销售姓名" prop="name")
        el-table-column(align="center" label="电话" prop="phone")
        el-table-column(align="center" label="城市" prop="city")
        el-table-column(align="center" label="性别" prop="sex")
        el-table-column(align="center" label="身份证号" prop="id_card")
        el-table-column(align="center" label="所属车商" prop="business")
        el-table-column(align="center" label="已审核")
            template(slot-scope="scope") {{scope.row.is_checked===1?'是':'否'}}
        el-table-column(align="center" label="操作")
            template(slot-scope="scope")
                el-button(type="text" @click="appoint(scope.row)") 指定车商
                el-button(type="text" v-if="scope.row.is_checked===0" @click="pass(scope.row)") 审核通过
                el-button(type="text" @click="reject(scope.row)") 删除
                el-button(type="text" @click="edit(scope.row)") 修改信息
    .pager
        el-pagination(
            layout="total,slot,prev,pager,next"
            :current-page.sync="pagination.curPage"
            :page-size="pagination.pageSize"
            :total="pagination.pageTotal"
            @current-change="pageCurPageChange"
            @size-change="pageSizeChange")
    dealer-appoint(ref="dealer-appoint" @success="req")
    saler-editor(ref="saler-editor" @success="req")
</template>

<script>
import pageMixin from '@/mixins/page';
import DealerAppoint from './components/DealerAppoint.vue';
import SalerEditor from './components/SalerEditor.vue';
export default {
    mixins: [pageMixin],
    components: {DealerAppoint, SalerEditor},
    data () {
        return {
            list: []
        };
    },
    methods: {
        appoint (data) {
            let comp = this.$refs['dealer-appoint'];
            comp.setUId(data.uid);
            comp.open();
        },
        edit (data) {
            let comp = this.$refs['saler-editor'];
            comp.setData(data);
            comp.open();
        },
        async pass (data) {
            try {
                if (data.business === '') {
                    this.$alert('未指定车商，不能审核通过');
                    return false;
                }
                await this.$confirm('确认审核通过吗？');
                await this.$http.post('/admin/business/salercheck', {
                    uid: data.uid
                });
                this.success('审核成功');
                this.req();
            } catch (error) {
                console.log(error);
            }
        },
        async reject (data) {
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
        async req () {
            try {
                let params = {
                    p: this.pagination.curPage
                };
                let { data } = await this.$http.post('/admin/business/salerlist', params);
                this.dealData(data.data);
            } catch (error) {
                console.log(error);
            }
        }
    },
    created () {
        this.req();
    }
};
</script>
