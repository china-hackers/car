<template lang="pug">
    el-container(id="container")
        el-aside(id="aside" width="200px")
            my-aside
        el-container
            el-header(id="header")
                my-header
            el-main(id="main")
                router-view
</template>

<script>
import Header from './components/Header';
import Aside from './components/Aside';
export default {
    components: {
        'my-header': Header,
        'my-aside': Aside
    },
    computed: {},
    methods: {},
    created() {
        this.$store.dispatch('getFirstUnread');
        setInterval(() => {
            this.$store.dispatch('getUnread');
        }, 5000);
    }
};
</script>

<style lang="scss">
html,
body {
    min-width: 1200px;
    height: 100%;
    font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB',
        'Microsoft YaHei', '微软雅黑', Arial, sans-serif;
    line-height: 100%;
    #container {
        height: 100%;
    }
}
</style>

<style lang="scss" scoped>
#aside {
    overflow: hidden;
    height: 100%;
}
</style>
