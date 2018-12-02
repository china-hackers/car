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

        el-submenu(index="car" :class="{dot:curUnread.buy>originUnread.buy}")
            template(slot="title")
                i(class="el-icon-menu")
                span 汽车管理
            el-menu-item-group
                el-menu-item(index="/car/lib") 车库
                el-menu-item(index="/car/types") 车型管理
                el-menu-item(index="/car/order" :class="{dot:curUnread.buy>originUnread.buy}") I品车订单

        el-submenu(index="loan" :class="{dot:curUnread.loan>originUnread.loan}")
            template(slot="title")
                i(class="el-icon-menu")
                span I品金融
            el-menu-item-group
                el-menu-item(index="/finance" :class="{dot:curUnread.loan>originUnread.loan}") 未成交
                el-menu-item(index="/finance/deal") 已成交

        el-submenu(index="insurance" :class="{dot:curUnread.safe>originUnread.safe}")
            template(slot="title")
                i(class="el-icon-menu")
                span I品车险
            el-menu-item-group
                el-menu-item(index="/insurance" :class="{dot:curUnread.safe>originUnread.safe}") 未成交
                el-menu-item(index="/insurance/deal") 已成交

        el-submenu(index="content")
            template(slot="title")
                i(class="el-icon-menu")
                span 内容管理
            el-menu-item-group
                el-menu-item(index="/content/banner") 首页幻灯
                el-menu-item(index="/content/tuijian") 首页推荐位

</template>

<script>
import { mapState } from 'vuex';
export default {
    data() {
        return {
            activeIndex: ''
        };
    },

    mounted() {
        // let index = window.location.hash.replace('#', '').split('/')[1];
        // this.activeIndex = '/' + index;
    },

    computed: mapState({
        originUnread: state => state.originUnread,
        curUnread: state => state.curUnread
    })
};
</script>

<style lang="scss">
.comp-aside {
    height: 100%;
    overflow: auto;
    .aside-menu {
        height: 100%;
    }
    .el-menu-item-group {
        overflow: hidden;
    }
    .el-submenu {
        &.dot {
            position: relative;
            &:after {
                content: ' ';
                width: 6px;
                height: 6px;
                background: red;
                position: absolute;
                top: 18px;
                left: 20px;
                border-radius: 50%;
            }
        }
    }
    .el-menu-item {
        &.dot {
            position: relative;
            &:after {
                content: ' ';
                width: 6px;
                height: 6px;
                background: red;
                position: absolute;
                top: 15px;
                left: 35px;
                border-radius: 50%;
            }
        }
    }
}
</style>
