<template lang="pug">
.comp-img
    a.bg-image(:href="src" target="_blank" v-bgsrc="src")
        slot
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
.comp-img {
    width: 100px;
    height: 50px;
    margin: 0 auto;
    a {
        display: block;
        width: 100%;
        height: 100%;
    }
}
</style>
