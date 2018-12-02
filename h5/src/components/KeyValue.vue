<template lang="pug">
.van-cell.comp-key-value
    .item(v-for="item in list")
        .key {{item.key}}
        .value {{item.val}}
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
    }
};
</script>

<style lang="scss" scoped>
.comp-key-value {
    // padding: 1rem;
    flex-wrap: wrap;
    color: #666;
    padding-left: 2rem;
    .item {
        display: flex;
        align-items: flex-start;
        padding: 0.5rem 0;
        .key {
            width: 10rem;
        }
        .value {
            width: 12rem;
        }
    }
}
</style>
