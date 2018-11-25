<template lang="pug">
el-dialog(title="新增贷款" :visible.sync="visible" width="800px")
    .comp-user-editor
        el-form(label-width="120px" label-position="left")
            el-form-item(label="姓名")
                el-input
            el-form-item(label="电话")
                el-input
            el-form-item(label="贷款类型")
                el-select.form-item-1(v-model="test")
                    el-option(label="新车贷款" value="index")
                    el-option(label="二手车贷款" value="index")
                    el-option(label="有车贷款" value="index")
            el-form-item(label="贷款时间")
                el-date-picker(type="date")
            el-form-item(label="推荐人")
                el-input
            el-form-item(label="是否已借出")
                el-radio-group
                    el-radio(label="1") 是
                    el-radio(label="1") 否
            el-form-item(label="")
                my-button(type="primary" :loading="saveing") 保存
</template>

<script>
import dialogMixin from '@/mixins/dialog';
export default {
    mixins: [dialogMixin],
    components: {
    },
    data () {
        return {
            test: '',
            form: {},
            saveing: false
        };
    }
};
</script>

<style lang="scss" scoped>
.comp-user-editor {
    width: 500px;
    padding-left: 40px;
    .el-checkbox {
        margin-left: 0;
        margin-right: 30px;
        &:last-child {
            margin-right: 0;
        }
    }
}
</style>
