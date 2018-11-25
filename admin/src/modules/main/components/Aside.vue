<template lang="pug">
.comp-aside
    el-menu(class="aside-menu" :default-active="activeIndex" background-color="#304156" text-color="#bfcbd9" active-text-color="#409EFF" :router="true")
        el-submenu(index="permission")
            template(slot="title")
                i(class="el-icon-menu")
                span 权限管理
            el-menu-item-group
                el-menu-item(index="/permission/admin-list") 管理员列表
                el-menu-item(index="/permission/list") 权限配置
                el-menu-item(index="/permission/role-list") 角色列表

        el-submenu(index="user")
            template(slot="title")
                i(class="el-icon-menu")
                span 用户管理
            el-menu-item-group
                el-menu-item(index="/user/index") 普通用户
                el-menu-item(index="/user/dealer-list") 车商
                el-menu-item(index="/user/saler-list") I品车销售

        el-submenu(index="car")
            template(slot="title")
                i(class="el-icon-menu")
                span 汽车管理
            el-menu-item-group
                el-menu-item(index="/car/lib") 车库
                el-menu-item(index="/car/types") 车型管理
                el-menu-item(index="/car/order") I品车订单

        el-submenu(index="loan")
            template(slot="title")
                i(class="el-icon-menu")
                span I品金融
            el-menu-item-group
                el-menu-item(index="/finance") 未成交
                el-menu-item(index="/finance/deal") 已成交

        el-submenu(index="insurance")
            template(slot="title")
                i(class="el-icon-menu")
                span I品车险
            el-menu-item-group
                el-menu-item(index="/insurance") 未成交
                el-menu-item(index="/insurance/deal") 已成交

        //- el-menu-item(index="/finance")
        //-     i(class="el-icon-menu")
        //-     span(slot="title") I品金融
        //- el-menu-item(index="/insurance")
        //-     i(class="el-icon-menu")
        //-     span(slot="title") I品车险

        el-submenu(index="content")
            template(slot="title")
                i(class="el-icon-menu")
                span 内容管理
            el-menu-item-group
                el-menu-item(index="/content/banner") 首页幻灯
            el-menu-item-group
                el-menu-item(index="/content/tuijian") 首页推荐位

</template>

<script>
export default {
    data () {
        return {
            activeIndex: ''
        };
    },
    mounted () {
        // let index = window.location.hash.replace('#', '').split('/')[1];
        // this.activeIndex = '/' + index;
    },
    beforeRouteUpdate () {
        console.log(arguments);
    }
};
</script>

<style lang="scss" scoped>
.comp-aside {
    height: 100%;
    .aside-menu {
        height: 100%;
    }
}
</style>
