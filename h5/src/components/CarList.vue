<template lang="pug">
van-list.comp-car-list(:loading="loading" :finished="finished" @load="onLoad" :offset="600")
    .item(v-for="item in list" :class="type" @click="jumpToDetail(item)")
        .cover.bg(v-lazy:background-image="item.img")
        .info
            .title {{item.title}}
            .sub {{item.years}}年/{{item.km}}万公里
            .bottom
                .cur {{item.price}}万
                .new 新车价
                    span {{item.price_new}}万
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            default: 'cell' // row or cell
        },
        count: {
            type: Number,
            default: 10
        },
        filter: {
            type: Object,
            default() {
                return {};
            }
        },
        params: {
            type: Object,
            default() {
                return {};
            }
        }
    },
    data() {
        return {
            curPage: 1,
            loading: false,
            finished: false,
            list: []
        };
    },
    watch: {
        filter() {
            this.research();
        }
    },
    methods: {
        jumpToDetail(item) {
            this.$router.push({
                path: '/car/detail',
                query: {
                    id: item.id
                }
            });
        },
        research() {
            this.curPage = 1;
            this.finished = false;
            this.list = [];
            this.onLoad();
        },
        async onLoad() {
            if (!this.loading) {
                this.loading = true;
                try {
                    let { data } = await this.$http.post(
                        '/mobile/product/list',
                        {
                            p: this.curPage,
                            ...this.filter,
                            ...this.params
                        }
                    );
                    this.list = this.list.concat(data.list);
                    if (this.list.length >= data.total) {
                        this.finished = true;
                    }
                    this.curPage += 1;
                } catch (error) {
                    console.log(error);
                }
                this.loading = false;
            }
        }
    }
};
</script>

<style lang="scss">
.comp-car-list {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    padding: 0 1rem;
    .item {
        padding-bottom: 1rem;
        .title {
            padding-top: 0.4rem;
            line-height: 1.2rem;
        }
        .sub {
            font-size: 0.8rem;
            color: #999;
            padding-top: 0.4rem;
        }
        .bottom {
            display: flex;
            padding-top: 0.6rem;
            justify-content: space-between;
            .cur {
                color: rgb(240, 120, 57);
            }
            .new {
                color: #999;
                font-size: 0.8rem;
                span {
                    text-decoration: line-through;
                }
            }
        }
    }
    .item.cell {
        width: 11rem;
        &:nth-child(2n) {
            margin-left: 1rem;
        }
        .cover {
            width: 11rem;
            height: 7rem;
            margin: 0 auto;
            box-shadow: 0 0 5px #ccc;
        }
        .title {
            padding-top: 0.4rem;
        }
    }

    .item.row {
        display: flex;
        align-items: flex-start;
        .cover {
            width: 9rem;
            height: 5.73rem;
            margin: 0 auto;
            box-shadow: 0 0 5px #ccc;
            flex-shrink: 0;
            margin-right: 1rem;
        }
    }

    .van-list__loading {
        width: 100%;
    }
}
</style>
