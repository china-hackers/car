<template lang="pug">
.comp-home-menu.flex
    .item.car(@click="jump('/main/car')")
        i.iconfont &#xe602;
        .text i 品车
    .item.finance(@click="jump('/loan')")
        i.iconfont &#xe747;
        .text i 品金融
    .item.insurance(@click="jump('/safe')")
        i.iconfont &#xe64b;
        .text i 品车险
    .item.life(@click="jump('/life')")
        i.iconfont &#xe78d;
        .text i 品车生活
    .item.rent(@click="nofunc")
        i.iconfont &#xe600;
        .text i 品租车
    .item.fix(@click="nofunc")
        i.iconfont &#xe61a;
        .text i 品汽修
</template>

<script>
export default {
    methods: {
        jump (path) {
            this.$router.push({
                path
            });
        },
        nofunc () {
            this.$dialog.alert({
                message: '对不起，该功能暂未开放'
            });
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-home-menu {
    flex-wrap: wrap;
    justify-content: center;
    .item {
        width: 33%;
        height: 5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        i {
            font-size: 2rem;
            line-height: 100%;
        }
        .text {
            padding-top: 0.4rem;
        }
        &.car {
            i {
                color: #f04c03;
            }
        }
        &.finance {
            i {
                color: #d9250d;
            }
        }
        &.insurance {
            i {
                color: #1296db;
            }
        }
        &.life {
            i {
                color: #058804;
            }
        }
        &.rent {
            i {
                color: #13227a;
            }
        }
        &.fix {
            i {
                color: #8c0067;
            }
        }
    }
}
</style>
