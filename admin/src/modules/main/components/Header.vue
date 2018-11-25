<template lang="pug">
.comp-header
    el-dropdown(class="avatar-container" trigger="hover")
        div(class="avatar-wrapper")
            | 个人管理
            i(class="el-icon-arrow-down el-icon--right")
        el-dropdown-menu(slot="dropdown" class="user-dropdown")
            el-dropdown-item
                span(style="display:block;" @click="jump('/reset-pwd')") 修改密码
            el-dropdown-item(divided)
                span(style="display:block;" @click="logout") 登出
</template>

<script>
export default {
    methods: {
        async logout () {
            try {
                window.location.href = '/admin/site/logout';
            } catch (error) {
                console.log(error);
            }
        },
        jump (path) {
            this.$router.push({
                path
            });
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-header {
    height: 59px;
    border-bottom: 1px solid #e6e6e6;
    display: flex;
    flex-direction: row-reverse;
    align-items: center;
    > * {
        margin-left: 20px;
        flex-shrink: 0;
    }
    .avatar-container {
        cursor: pointer;
        .avatar-wrapper {
            display: flex;
            align-items: center;
            img {
                width: 40px;
                height: 40px;
                border-radius: 100%;
            }
        }
    }
}
</style>
