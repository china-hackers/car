<template lang="pug">
.comp-avatar
    .avatar(v-if="src" v-background-image="src")
    span(v-else) 无
</template>

<script>
export default {
    props: {
        src: {
            type: String,
            default: ''
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-avatar {
    width: 40px;
    height: 40px;
    border-radius: 20px;
    background-color: #f5f5f5;
    text-align: center;
    line-height: 40px;
    margin: 0 auto;
    flex-shrink: 0;
    flex-grow: 0;
    .avatar {
        width: 100%;
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    span {
        font-size: 16px;
        color: #666;
    }
}
</style>
