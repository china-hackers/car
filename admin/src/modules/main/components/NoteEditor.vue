<template lang="pug">
el-dialog(title="查看备注" :visible.sync="visible" width="800px")
    .comp-note-editor
        el-table(:data="list" border style="width: 100%")
            el-table-column(align="center" type="index")
            el-table-column(align="center" label="备注时间" prop="created")
                template(slot-scope="scope") {{formatDate(new Date(scope.row.created*1000))}}
            el-table-column(align="center" label="备注内容" prop="note")
        el-form.form
            el-form-item
                el-input(type="textarea" v-model="note" placeholder="备注内容")
            el-form-item
                my-button(type="primary" :click="save") 保存

</template>

<script>
import dialogMixin from '@/mixins/dialog';
import pageMixin from '@/mixins/page';
import { formatDate } from '@/lib/util';
export default {
    mixins: [dialogMixin, pageMixin],
    props: {
        'list-url': {
            type: String,
            default: ''
        },
        'add-url': {
            type: String,
            default: ''
        },
        'post-key': {
            type: String,
            default: 'lid'
        }
    },
    data() {
        return {
            id: '',
            list: [],
            note: ''
        };
    },
    methods: {
        async setDefaultValues() {
            try {
                let { data } = await this.$http.post(this.listUrl, {
                    p: this.pagination.curPage,
                    id: this.id
                });
                this.list = data.data.list;
                this.pagination.pageTotal = data.data.total;
            } catch (error) {
                console.log(error);
            }
        },
        setId(id) {
            this.id = id;
        },
        formatDate(date) {
            return formatDate(date);
        },
        async save() {
            try {
                if (this.note === '') {
                    this.error('备注内容不能为空');
                    return false;
                }
                let params = {
                    note: this.note
                };
                params[this.postKey] = this.id;
                await this.$http.post(this.addUrl, params);
                this.success('保存成功');
                this.note = '';
                this.setDefaultValues();
            } catch (error) {
                console.log(error);
            }
        },
        clear() {
            this.id = '';
            this.note = '';
            this.list = [];
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-note-editor {
    .form {
        padding-top: 20px;
    }
}
</style>
