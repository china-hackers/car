<template lang="pug">
.comp-home-hot-car
    .top.bg(v-lazy:background-image="img")
    .bottom.flex
        .item(v-for="item in car" @click="$router.push({path: item.url})")
            .title {{item.title}}
            .type {{item.model}}
            .tag {{item.keyword}}
            .img.bg(v-lazy:background-image="item.img")

</template>

<script>
export default {
    data() {
        return {
            img: '',
            car: []
        };
    },
    async created() {
        try {
            let { data } = await this.$http.post('/mobile/banner/recommand', {
                p: 1
            });
            Object.assign(this, data);
        } catch (error) {
            console.log(error);
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-home-hot-car {
    .top {
        background-color: rgb(232, 99, 82);
        height: 6.4rem;
    }
    .bottom {
        align-items: flex-start;
        justify-content: center;
        .item {
            width: 33%;
            text-align: center;
            padding: 1rem 0;
            .title {
                color: #e86352;
            }
            .type {
                color: #999;
                font-size: 0.8rem;
                padding-top: 0.5rem;
            }
            .tag {
                display: inline-block;
                background-color: #e86352;
                color: #fff;
                font-size: 0.8rem;
                padding: 0.2rem;
                margin: 0.5rem 0;
            }
            .img {
                width: 5rem;
                height: 5rem;
                margin: 0 auto;
            }
        }
    }
}
</style>
