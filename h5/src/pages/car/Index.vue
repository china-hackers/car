<template lang="pug">
.page-car
    my-header(v-model="title" @search="search")
    car-filter(v-model="filter" @filter-change="handleFilterChange")
    .car-filter-2
        .item(v-for="item in itypes" :class="{cur:itype===item}" @click="switchIType(item)") {{item}}
    car-list.list(type="row" :filter="allFilter")
</template>

<script>
import CarFilter from '@/components/CarFilter';
import CarList from '@/components/CarList';
export default {
    components: {
        'car-filter': CarFilter,
        'car-list': CarList
    },
    data() {
        return {
            finished: false,
            curPage: 1,
            title: '',
            itypes: ['i尊车', 'i品车', 'i享车', 'i优车', 'i值车'],
            itype: '',
            filter: {}
        };
    },
    computed: {
        allFilter() {
            return {
                itype: this.itype,
                title: this.title,
                ...this.filter
            };
        }
    },
    methods: {
        switchIType(type) {
            this.itype = type;
        },
        handleFilterChange() {},
        search() {}
    },
    created() {
        this.itype = this.$route.query.itype;
        this.filter.brand = this.$route.query.brand;
        this.title = this.$route.query.title;
    }
};
</script>

<style lang="scss" scoped>
.page-car {
    .car-filter-2 {
        display: flex;
        align-items: center;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        .item {
            width: 20%;
            text-align: center;
            font-size: 0.87rem;
            padding: 0.5rem 0;
            border-right: 1px solid #eee;
            &:last-child {
                border-right: 0 none;
            }
            &.cur {
                background-color: #f04c03;
                color: #fff;
            }
        }
    }
    .list {
        margin-top: 1rem;
    }
}
</style>
