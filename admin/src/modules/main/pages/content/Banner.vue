<template lang="pug">
.page-employee
    my-page-title(title="首页导航")
    .bar
        el-form(:inline="true" @click.native.prevent="")
            el-form-item
                my-button(type="primary" :loading="loading" :click="newItem") 新增导航
    .content(v-loading="loading")
        el-table(:data="list" border style="width: 100%")
            el-table-column(align="center" type="index")
            el-table-column(align="center" label="到期时间" prop="outdate")
            el-table-column(align="center" label="创建时间" prop="created")
            el-table-column(align="center" label="跳转链接" prop="url")
            el-table-column(align="center" label="图片" prop="img")
                template(slot-scope="scope")
                    my-image(:src="scope.row.img")
            el-table-column(align="center" label="操作" prop="")
                template(slot-scope="scope")
                    el-button(type="text" @click="editItem(scope.row)") 修改
                    el-button(type="text" @click="deleteItem(scope.row)") 删除
        .pager
            el-pagination(:page-sizes="[20]"
                layout="total,slot,prev,pager,next"
                :current-page.sync="pagination.curPage"
                :page-size="pagination.pageSize"
                :total="pagination.pageTotal"
                @current-change="pageCurPageChange"
                @size-change="pageSizeChange")
    banner-item-editor(ref="banner-item-editor" @save-success="getList")
</template>

<script>
import pageMixin from '@/mixins/page';
import { formatDate } from '@/lib/util';
import BannerItemEditor from './components/BannerItemEditor';
export default {
    mixins: [pageMixin],
    data () {
        return {
            list: [],
            name: '',
            loading: false
        };
    },
    components: {
        'banner-item-editor': BannerItemEditor
    },
    methods: {
        editItem (item) {
            let comp = this.$refs['banner-item-editor'];
            comp.setData(item);
            comp.open();
        },
        newItem () {
            let comp = this.$refs['banner-item-editor'];
            comp.open();
        },
        async deleteItem (data) {
            try {
                await this.$confirm('确认删除吗？');
                await this.$http.post('/admin/banner/delete', {
                    id: data.id
                });
                this.success('删除成功');
                this.getList();
            } catch (error) {
                console.log(error);
            }
        },
        research () {
            this.pagination.curPage = 1;
            this.list = [];
            this.getList();
        },
        async getList () {
            try {
                let { data } = await this.$http.post('/admin/banner/list', {
                    p: this.pagination.curPage,
                    name: this.name
                });
                this.list = data.data.list;
                this.pagination.pageTotal = data.data.total;
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
                await this.$http.post('/admin/finance/loancheck', {
                    id: item.id
                });
                this.success('提交成功');
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
.page-employee {
    .bar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }
}
</style>
