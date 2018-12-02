<template lang="pug">
.comp
    .title 我的资料
    .list
        .img.bg(v-for="(item, index) in list" v-lazy:background-image="item" @click="preview(index)")
</template>

<script>
export default {
    props: {
        list: {
            type: Array,
            default() {
                return [];
            }
        }
    },
    methods: {
        preview(index) {
            this.ImagePreview({
                images: this.list,
                startPosition: index
            });
        }
    }
};
</script>

<style lang="scss" scoped>
.title {
    padding: 1rem 1rem 0 1rem;
    font-size: 1.2rem;
}
.list {
    padding: 1rem;
    display: flex;
    flex-wrap: wrap;
    .img {
        width: 11rem;
        height: 11rem;
        display: block;
        margin-bottom: 1rem;
        &:nth-child(2n + 1) {
            margin-right: 1rem;
        }
    }
}
</style>
