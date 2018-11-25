<template lang="pug">
.page
    my-nav-bar(title="我的贷款")

    .row1
        .title 当月应还款(元)
        .val {{data.d_pay}}
    .row2
        .cell
            i.iconfont &#xe62c;
            .info
                .title 贷款总额
                .val {{data.d_money}}
        .cell
            i.iconfont &#xe608;
            .info
                .title 剩余期数(月)
                .val {{data.d_left}}
    //- van-cell-group
        van-cell(title="贷款总额" :value="`${data.d_money}元`")
        //- van-cell(title="剩余贷款金额" :value="`${data.d_left}元`")
        van-cell(title="贷款时间" :value="`${data.d_month}月`")
        van-cell(title="每月还款金额" :value="`${data.d_pay}元`")
    imgs(:list="data.imgs")
</template>

<script>
import Imgs from './components/Imgs';
export default {
    components: {
        Imgs
    },
    data () {
        return {
            data: {
                d_money: 0,
                d_month: 0,
                d_pay: 0,
                d_left: 0,
                imgs: []
            }
        };
    },
    async created () {
        try {
            let {data} = await this.$http.post('/mobile/user/loan', {p: 1});
            this.data = data;
        } catch (error) {
            console.log(error);
        }
    }
};
</script>

<style lang="scss" scoped>
.page {
    .row1 {
        border-bottom: 1px solid #eee;
        text-align: center;
        padding: 2rem 0;
        .title {
            color: #999;
        }
        .val {
            color: #f04c03;
            padding-top: 1rem;
            font-size: 1.6rem;
        }
    }
    .row2 {
        display: flex;
        text-align: center;
        border-bottom: 1px solid #eee;
        .cell {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem 0;
            &:first-child {
                border-right: 1px solid #eee;
            }
            .iconfont {
                color: #f04c03;
                font-size: 1.8rem;
                padding-right: 0.5rem;
            }
            .title {
                color: #666;
            }
            .val {
                color: #999;
                padding-top: 0.6rem;
                text-align: left;
            }
        }
    }
}
</style>
