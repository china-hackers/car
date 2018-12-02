<template lang="pug">
.comp-banner(@click="handleItemClick")
    van-swipe(:autoplay="3000" @change="handleChange")
        van-swipe-item(v-for="(item, index) in list" :key="item.id")
            .bg.img(v-lazy:background-image="item.img")
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
    data() {
        return {
            curIndex: 0
        };
    },
    methods: {
        handleItemClick() {
            this.$emit('item-click', this.curIndex);
        },
        handleChange(index) {
            this.curIndex = index;
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-banner {
    height: 14rem;
    .img {
        height: 14rem;
    }
}
</style>
