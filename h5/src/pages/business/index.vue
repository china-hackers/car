<template lang="pug">
.page
    my-nav-bar(title="车商中心")
    .menu
        menu-item.item(icon="&#xe607;" v-if="role==='车商'" text="上传车辆" path="/business/new")
        menu-item.item(icon="&#xe602;" v-if="role==='车商'" text="车辆管理" path="/business/cars")
        menu-item.item(icon="&#xe66f;" v-if="role==='车商'" text="我的销售" path="/business/salers")
        menu-item.item(icon="&#xe66d;" v-if="role==='车商'" text="车商信息" path="/business/info")
        menu-item.item(icon="&#xe605;" text="我的客户" path="/business/customers")
        menu-item.item(icon="&#xe603;" v-if="role==='车商'" text="我的二维码" path="/business/qr")
</template>

<script>
import MenuItem from './components/MenuItem';
export default {
    data() {
        return {
            role: ''
        };
    },
    components: {
        MenuItem
    },
    created() {
        this.role = this.$route.query.role;
    }
};
</script>

<style lang="scss" scoped>
.page {
    .menu {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        .item {
            width: 33.33%;
            height: 8rem;
            &:nth-child(3n) {
                border-right: 0 none;
            }
        }
    }
}
</style>
