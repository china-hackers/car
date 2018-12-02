<template lang="pug">
.comp-common-bar
    .form
        el-form(:inline="true" @click.native.prevent="" v-if="formDisplay")
            el-form-item
                el-input(placeholder="请输入管理员姓名")
            el-form-item
                my-button(type="primary" :loading="loading") 搜索
    el-button(type="primary" @click="handleNew") {{newBtnText}}
</template>

<script>
export default {
    props: {
        formDisplay: {
            type: Boolean,
            default: true
        },
        newBtnText: {
            type: String,
            default: ''
        }
    },
    methods: {
        handleNew() {
            this.$emit('new');
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-common-bar {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding-bottom: 20px;
    .el-form-item {
        margin-bottom: 0;
    }
}
</style>
