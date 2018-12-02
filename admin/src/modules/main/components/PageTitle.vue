<template lang="pug">
.comp-page-title
    h1 {{title}}
    el-button(v-if="btnVisible" size="medium" type="primary" @click="handleClick") {{btnText}}
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: ''
        },
        btnVisible: {
            type: Boolean,
            default: false
        },
        btnText: {
            type: String,
            default: '新增'
        }
    },
    methods: {
        handleClick() {
            this.$emit('right-click');
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-page-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 20px;
    h1 {
        font-size: 18px;
        line-height: 100%;
    }
}
</style>
