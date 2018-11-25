<template lang="pug">
.page-car-insurance
    my-nav-bar(title="我的收藏")
    .list
        car-list(type="row" :params="{store:1}")
</template>

<script>
import CarList from '@/components/CarList';
export default {
    components: {
        CarList
    }
};
</script>
<style lang="scss" scoped>
.list {
    padding-top: 1rem;
}
</style>
