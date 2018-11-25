<template lang="pug">
el-dialog(title="指定车商" :visible.sync="visible" width="800px")
    .comp
        el-form(:inline="true" @click.native.prevent="")
            el-form-item
                el-input(placeholder="请输入车行名称" v-model="filter.name" @change="research")
            el-form-item
                my-button(:click="research") 搜索
        el-table(:data="list" border style="width: 100%")
            el-table-column(align="center" type="index")
            el-table-column(align="center" label="车行名称" prop="name")
            el-table-column(align="center" label="电话号码" prop="phone")
            el-table-column(align="center" label="地址" prop="address")
            el-table-column(align="center" label="操作")
                template(slot-scope="scope")
                    el-button(type="primary" size="small" @click="appoint(scope.row)") 指定
        .pager
            el-pagination(
                layout="total,slot,prev,pager,next"
                :current-page.sync="pagination.curPage"
                :page-size="pagination.pageSize"
                :total="pagination.pageTotal"
                @current-change="pageCurPageChange"
                @size-change="pageSizeChange")

</template>

<script>
import dialogMixin from '@/mixins/dialog';
import pageMixin from '@/mixins/page';
export default {
    mixins: [pageMixin, dialogMixin],
    data () {
        return {
            filter: {
                name: '',
                check: 1
            },
            uid: '',
            list: []
        };
    },
    methods: {
        async req () {
            try {
                let params = {
                    p: this.pagination.curPage,
                    ...this.filter
                };
                let { data } = await this.$http.post('/admin/business/list', params);
                this.dealData(data.data);
            } catch (error) {
                console.log(error);
            }
        },
        setUId (id) {
            this.uid = id;
        },
        async appoint (data) {
            try {
                await this.$http.post('/admin/business/bind', {
                    uid: this.uid,
                    bid: data.id
                });
                this.success('指定成功');
                this.$emit('success');
                this.close();
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
