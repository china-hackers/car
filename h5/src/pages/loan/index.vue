<template lang="pug">
.page-loan
    //- my-nav-bar(title="I品金融")
    .item.p1(@click="jumpToForm")
    .item.p2(@click="jumpToForm")
    .item.p3(@click="jumpToForm")
</template>

<script>
export default {
    methods: {
        jumpToForm() {
            this.$router.push('/loan/form');
        }
    }
};
</script>

<style lang="scss" scoped>
.page-loan {
    .item {
        margin: 1rem;
        width: 23rem;
        height: 11.68rem;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        &.p1 {
            background-image: url(../../assets/1.png);
        }
        &.p2 {
            background-image: url(../../assets/2.png);
        }
        &.p3 {
            background-image: url(../../assets/3.png);
        }
    }
}
</style>
