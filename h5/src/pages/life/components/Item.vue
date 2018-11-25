<template lang="pug">
.comp-life-item(@click="goDetail")
    .img.bg(:class="data.bg")
    .title {{data.title}}
    .info
        .price ¥ {{data.score}}分
        .text 已兑换0件
</template>

<script>
export default {
    props: {
        data: {
            type: Object,
            default () {
                return {};
            }
        }
    },
    methods: {
        goDetail () {
            this.$dialog.alert({
                message: '对不起，该功能暂未开放'
            });
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-life-item {
    width: 11rem;
    margin: 1rem 0 0 1rem;
    .img {
        width: 11rem;
        height: 11rem;
        border: 1px solid #eee;
        &.zt {
            background-image: url(../../../assets/goods/zt.png);
        }
        &.bb {
            background-image: url(../../../assets/goods/bb.png);
        }
        &.sh {
            background-image: url(../../../assets/goods/sh.png);
        }
        &.kd {
            background-image: url(../../../assets/goods/kd.png);
        }
    }
    .title {
        font-size: 1rem;
        padding: 0.7rem 0;
        line-height: 1.4rem;
    }
    .info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        .price {
            color: rgb(240, 120, 57);
            font-size: 1.2rem;
        }
        .text {
            color: #999;
        }
    }
}
</style>
