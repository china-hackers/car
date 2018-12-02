<template lang="pug">
.comp-home-quick
    .item(@click="jump('itype', 'i尊车')") i尊车
    .item(@click="jump('itype', 'i品车')") i品车
    .item(@click="jump('itype', 'i享车')") i享车
    .item(@click="jump('itype', 'i优车')") i优车
    .item(@click="jump('brand', '大众')") 大众
    .item(@click="jump('brand', '日产')") 日产
    .item(@click="jump('brand', '捷豹')") 捷豹
    .item(@click="jump('brand', '宝马')") 宝马
</template>

<script>
export default {
    methods: {
        jump(type, value) {
            let query = {};
            query[type] = value;
            this.$router.push({
                path: '/main/car',
                query
            });
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-home-quick {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    padding-top: 1rem;
    .item {
        width: 25%;
        text-align: center;
        height: 2.5rem;
        line-height: 2.5rem;
    }
}
</style>
