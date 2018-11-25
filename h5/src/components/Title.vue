<template lang="pug">
.comp-title
    .title {{title}}
    .right(v-if="showRight" @click="handleRightClick")
        span {{rightText}}
        van-icon.icon(name="arrow")
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: ''
        },
        showRight: {
            type: Boolean,
            default: false
        },
        rightText: {
            type: String,
            default: ''
        }
    },
    methods: {
        handleRightClick () {
            this.$emit('right-click');
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-title {
    padding: 1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    .title {
        font-size: 1.2rem;
        line-height: 100%;
        border-left: 0.3rem solid #f04c03;
        text-indent: 0.6rem;
    }
    .right {
        display: flex;
        align-items: center;
        color: #999;
        .icon {
            font-size: 0.6rem;
        }
    }
}
</style>
