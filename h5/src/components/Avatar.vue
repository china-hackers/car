<template lang="pug">
.comp-avatar
    van-icon.icon(name="contact" v-if="src===''")
    .img.bg(v-else v-lazy:background-image="src")
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
    width: 4rem;
    height: 4rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #fff;
    border-radius: 50%;
    border: 1px solid #eee;
    overflow: hidden;
    .icon {
        font-size: 2rem;
        color: #ccc;
    }
    .img {
        width: 100%;
        height: 100%;
    }
}
</style>
