<template lang="pug">
.comp-my-nav-bar
    van-nav-bar(:fixed="true" :title="title" left-text="返回" left-arrow @click-left="handleLeftClick" @click-right="onClickRight")
        van-icon(v-if="rightIcon" :name="rightIcon" slot="right")
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: ''
        },
        rightIcon: {
            type: String,
            default: ''
        }
    },
    methods: {
        handleLeftClick () {
            if (history.length > 1) {
                history.back();
            } else {
                this.$router.push({
                    path: '/main/home'
                });
            }
        },
        onClickRight () {
            this.$emit('right-click');
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-my-nav-bar {
    height: 46px;
}
</style>
