<template lang="pug">
.page-home
    my-header
    my-banner(:list="banner" @item-click="handleItemClick")
    home-menu
    home-quick
    my-box
        home-hot-car
    my-box
        my-title(title="为你推荐")
        car-list(:params="{sort:'diy'}")
</template>

<script>
import Menu from './components/Menu';
import Quick from './components/Quick';
import HotCar from './components/HotCar';
import CarList from '@/components/CarList';
export default {
    components: {
        'home-menu': Menu,
        'home-quick': Quick,
        'home-hot-car': HotCar,
        'car-list': CarList
    },
    data() {
        return {
            banner: []
        };
    },
    methods: {
        async getBanner() {
            try {
                let { data } = await this.$http.post('/mobile/banner/list', {
                    p: 1
                });
                this.banner = data.list;
                console.log(data);
            } catch (error) {
                console.log(error);
            }
        },
        handleItemClick(index) {
            let item = this.banner[index];
            this.$router.push({
                path: item.url,
                query: {
                    id: item.pid
                }
            });
        }
    },
    created() {
        this.getBanner();
    }
};
</script>

<style lang="scss" scoped>
</style>
