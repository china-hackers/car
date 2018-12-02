<template lang="pug">
.page-safe
    my-nav-bar(title="I品车险")
    van-collapse(v-model="activeName" accordion)
        van-collapse-item(title="车损险" name="1") 车损是保自己车的险种，比如自己车发生单车事故或者在撞了人家的车自己车受损的情况下修理自己是车
        van-collapse-item(title="三者险" name="2") 三者险的用途，三者的标准是从5万到300万三者险是在途中由于自己的责任问题给对方造成的损失不管是人还是车或者其他物品，用三者险来赔偿一般的三者险的标准配置50万-100万这个保额属于标配
        van-collapse-item(title="盗抢险" name="3") 盗抢险的用途，是指车辆被偷盗了保险公司根据当时保的金额来赔付，车辆被盗了应该立即报案在公安机关需要立案，在三个月内未找回保险公司给与理赔
        van-collapse-item(title="座位险" name="4") 座位险的用途，座位险也叫乘坐险是指坐在你车上的人员发生意外赔付的险种注册滴滴必须要购买此险种
        van-collapse-item(title="自燃险" name="5") 自燃险的用途，自燃险是指车辆在撞击或者由于天气原因线路老化的情况下发了燃烧损失由保险公司赔付
        van-collapse-item(title="涉水险" name="6") 涉水险的用途：涉水险是指车辆被水淹了之后不能在二次打火损失由保险公司来赔付。车辆在被水淹了直接打保险公司电话报案不能在二次打火否则不赔
        van-collapse-item(title="玻璃险" name="7") 玻璃险：玻璃险是指玻璃在人为或者外在因素破损的情况下由保险公司赔付
        van-collapse-item(title="划痕险" name="8") 划痕险：是指车辆有大面积的划伤需要大面积补漆的由保险公司赔付划痕险的保额有2000到5万一般根据车价来选择保额
        van-collapse-item(title="随车行李险" name="9") 随车行李险：随车行李险是一般保额在1000到10000是指放在车上的东西掉了根据实际价值由保险公司赔付。
        van-collapse-item(title="新增设备险" name="10") 新增设备险：是指车辆在后续加装上去的设备需要投保比如保险杠包围之类的东西根据实际发票来投保，发生损坏由保险公司赔付。

    my-bottom-bar.bottom(:click="jumpToForm")
        .btn 咨询车险
</template>

<script>
export default {
    data() {
        return {
            activeName: 1
        };
    },
    methods: {
        jumpToForm() {
            this.$router.push('/safe/form');
        }
    }
};
</script>

<style lang="scss">
.page-safe {
    .btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
    }
    .van-collapse-item__content {
        line-height: 1.4rem;
    }
}
</style>
