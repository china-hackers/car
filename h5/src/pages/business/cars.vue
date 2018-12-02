<template lang="pug">
.page
    my-nav-bar(title="车辆管理")
    van-tabs(v-model="active")
        van-tab(title="在售")
        van-tab(title="下架")
        van-tab(title="已售")
    van-list.list(:loading="loading" :finished="finished" @load="onLoad" :offset="600")
        van-swipe-cell.item(v-for="(item, index) in list" :key="item.id" :right-width="rightWidth")
            .cell.flex
                .cover.bg(v-lazy:background-image="item.img")
                .info
                    .title {{item.title}}
                    .bottom.flex
                        .type {{item.brand}}
                        .price {{item.price}}万
            .btns(slot="right" v-if="active==0")
                span.btn.green(@click="xiajia(item)") 下架
                span.btn.blue(@click="jump('/business/edit', item)") 编辑
            .btns(slot="right" v-if="active==1")
                span.btn.blue(@click="jump('/business/edit', item)") 编辑
                //- span.btn.red(@click="del(item, index)") 删除
</template>

<script>
export default {
    data() {
        return {
            active: 0,
            loading: false,
            finished: false,
            curPage: 1,
            list: []
        };
    },
    watch: {
        active(v) {
            this.active = v;
            this.research();
        }
    },
    computed: {
        rightWidth() {
            return {
                0: 120,
                1: 60,
                2: 0
            }[this.active];
        }
    },
    methods: {
        jump(path, item) {
            if (item.state === 2) {
                this.fail('已出售车辆无法修改');
                return false;
            }
            this.$router.push({
                path,
                query: {
                    id: item.id
                }
            });
        },
        async xiajia(item) {
            try {
                await this.confirm('确认下架吗？');
                await this.$http.post('/mobile/business/productclose', {
                    id: item.id
                });
                this.success('下架成功');
                this.research();
            } catch (error) {
                console.log(error);
            }
        },
        async del(item, index) {
            try {
                await this.confirm('确认删除吗？');
                await this.$http.post('/mobile/business/productdelete', {
                    id: item.id
                });
                this.success(' 删除成功');
                this.research();
            } catch (error) {
                console.log(error);
            }
        },
        research() {
            this.finished = false;
            this.list = [];
            this.curPage = 1;
            this.loading = false;
        },
        async onLoad() {
            if (!this.loading) {
                this.loading = true;
                try {
                    let { data } = await this.$http.post(
                        '/mobile/business/productlist',
                        {
                            p: this.curPage,
                            state: this.active
                        }
                    );
                    console.log(data);
                    this.list = this.list.concat(data.list);
                    if (this.list.length >= data.total) {
                        this.finished = true;
                    }
                    this.curPage += 1;
                } catch (error) {
                    this.finished = true;
                    console.log(error);
                }
                this.loading = false;
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.page {
    .list {
        .item {
            border-bottom: 1px solid #f5f5f5;
            .cell {
                padding: 0.7rem 1rem;
                align-items: flex-start;
                .cover {
                    width: 6rem;
                    height: 4rem;
                    margin: 0 auto;
                    box-shadow: 0 0 5px #ccc;
                    flex-shrink: 0;
                    margin: 0 1rem 0 0;
                }
                .info {
                    flex-grow: 1;
                    .tag {
                        margin-top: 0.4rem;
                    }
                    .bottom {
                        padding-top: 0.4rem;
                        color: #999;
                        justify-content: space-between;
                        .price {
                            color: #f04c03;
                        }
                    }
                }
            }
            .btns {
                width: 120px;
                height: 100%;
                display: flex;
                align-items: stretch;
                .btn {
                    display: block;
                    width: 60px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #fff;
                    &.green {
                        background-color: rgb(37, 155, 36);
                    }
                    &.blue {
                        background-color: rgb(65, 141, 255);
                    }
                    &.red {
                        background-color: rgb(255, 84, 84);
                    }
                }
            }
        }
    }
}
</style>
