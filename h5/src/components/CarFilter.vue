<template lang="pug">
.comp-car-filter
    .flex
        .item.flex.sort(@click="openPop('car-filter-sort-pop')")
            span {{orderName}}
            i.iconfont &#xe610;
        .item.flex(@click="openPop('car-filter-brand-pop')")
            span 品牌
            i.iconfont &#xe610;
        .item.flex(@click="openPop('car-filter-price-pop')")
            span 价格
            i.iconfont &#xe610;
        .item.flex(@click="openPop('car-filter-other-pop')")
            span 筛选
            i.iconfont &#xe610;

    car-filter-sort-pop(ref="car-filter-sort-pop" @change="handleOrderChange")
    car-filter-brand-pop(ref="car-filter-brand-pop" v-model="filter.brand" @change="emitValue")
    car-filter-price-pop(ref="car-filter-price-pop" @change="handlePriceFilterChange")
    car-filter-other-pop(ref="car-filter-other-pop" @change="handleOtherFilterChange")
</template>
<script>
import CarFilterSortPop from './CarFilterSortPop';
import CarFilterBrandPop from './CarFilterBrandPop';
import CarFilterPricePop from './CarFilterPricePop';
import CarFilterOtherPop from './CarFilterOtherPop';
export default {
    props: {
        value: {
            type: Object,
            default() {
                return {};
            }
        }
    },
    components: {
        'car-filter-sort-pop': CarFilterSortPop,
        'car-filter-brand-pop': CarFilterBrandPop,
        'car-filter-price-pop': CarFilterPricePop,
        'car-filter-other-pop': CarFilterOtherPop
    },
    watch: {
        value: {
            handler(v) {
                console.log(v);
                Object.assign(this.filter, v);
            },
            immediate: true
        }
    },
    data() {
        return {
            orderName: '智能排序',
            filter: {
                order: '',
                brand: '',
                shoufu_from: '',
                shoufu_to: '',
                yuegong_from: '',
                yuegong_to: '',
                price_from: '',
                price_to: '',
                displacement_from: '',
                displacement_to: '',
                gear_box: '',
                air_in: ''
            }
        };
    },
    methods: {
        handleOrderChange(order) {
            this.orderName = order.text;
            this.filter.order = order.value;
            this.emitValue();
        },
        handlePriceFilterChange(data) {
            Object.assign(this.filter, data);
            this.emitValue();
        },
        handleOtherFilterChange(data) {
            Object.assign(this.filter, data);
            this.emitValue();
        },
        openSortPop() {
            let comp = this.$refs['car-filter-sort-pop'];
            comp.open();
        },
        openPop(name) {
            let comp = this.$refs[name];
            comp.open();
        },
        emitValue() {
            this.$emit('input', this.filter);
            this.$emit('filter-change');
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-car-filter {
    .item {
        width: 22%;
        padding: 0.5rem 0;
        justify-content: center;
        span {
            font-size: 0.9rem;
        }
        &.sort {
            width: 34%;
        }
    }
}
</style>
