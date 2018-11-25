<template lang="pug">
.app
    router-view
    van-tabbar(v-model="active")
        van-tabbar-item(to="/main/home") 首页
            i.iconfont(slot="icon" slot-scope="props" :class="{active:props.active}") &#xe612;
        van-tabbar-item(to="/main/car") i品车
            i.iconfont.icon-che(slot="icon" slot-scope="props" :class="{active:props.active}")
        van-tabbar-item(to="/main/loan") i品金融
            i.iconfont.icon-jinrong(slot="icon" slot-scope="props" :class="{active:props.active}")
        van-tabbar-item(to="/main/profile") 我的
            i.iconfont(slot="icon" slot-scope="props" :class="{active:props.active}") &#xe601;
</template>

<script>
export default {
    data () {
        return {
            active: 0
        };
    },
    beforeRouteUpdate ({fullPath}, from, next) {
        fullPath = fullPath.replace('#', '').split('?')[0];
        this.active = {
            '/main/home': 0,
            '/main/car': 1,
            '/main/loan': 2,
            '/main/profile': 3
        }[fullPath] || 0;
        next();
    },
    created () {
        let path = window.location.hash.replace('#', '').split('?')[0];
        this.active = {
            '/main/home': 0,
            '/main/car': 1,
            '/main/loan': 2,
            '/main/profile': 3
        }[path] || 0;
    }
};
</script>

<style lang="scss" scoped>
.app {
    padding-bottom: 50px;
    .iconfont {
        font-size: 18px;
    }
}
</style>
