<template lang="pug">
.page-life
    my-nav-bar(title="I品车生活")
    .wrap
        item(v-for="item in items" :data="item" :key="item.bg")
</template>

<script>
import Item from './components/Item';
export default {
    components: {
        item: Item
    },
    data () {
        return {
            items: [
                {
                    bg: 'kd',
                    title: '汽车腰靠护腰记忆棉靠背垫座椅腰枕',
                    score: '8000'
                }, {
                    bg: 'bb',
                    title: 'CELESTRON星特朗天文望远镜配件 80DX 80eq收纳包',
                    score: '52000'
                }, {
                    bg: 'zt',
                    title: '雪仑尔五星级酒店高回弹纤维枕芯可水洗枕头',
                    score: '8000'
                }, {
                    bg: 'sh',
                    title: '美的（Midea电水壶 304不锈钢电热水壶 1.7L容量 ',
                    score: '8000'
                }
            ]
        };
    }
};
</script>

<style lang="scss" scoped>
.page-life {
    .wrap {
        display: flex;
        align-items: flex-start;
        flex-wrap: wrap;
    }
}
</style>
