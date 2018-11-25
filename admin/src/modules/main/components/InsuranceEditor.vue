<template lang="pug">
el-dialog(title="新增员工" :visible.sync="visible" width="800px")
    .comp-user-editor
        el-form(label-width="80px" label-position="left")
            el-form-item(label="姓名")
                el-input
            el-form-item(label="性别")
                el-radio-group
                    el-radio(label="1") 男
                    el-radio(label="0") 女
            el-form-item(label="联系方式")
                el-input
            el-form-item(label="家庭住址")
                el-input
            el-form-item(label="")
                my-button(type="primary" :loading="saveing") 保存
</template>

<script>
import dialogMixin from '@/mixins/dialog';
import MyButton from '@/components/MyButton';
export default {
    mixins: [dialogMixin],
    components: {
        'my-button': MyButton
    },
    data () {
        return {
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
