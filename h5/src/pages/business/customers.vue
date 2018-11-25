<template lang="pug">
.page
    my-nav-bar(title="我的客户")
    van-tabs(v-model="active")
        van-tab(title="进行中")
        van-tab(title="已成交")
        van-tab(title="已失效")
    van-list.list(:loading="loading" :finished="finished" @load="onLoad" :offset="600")
        van-swipe-cell.item(v-for="(item, index) in list" :key="item.id" :right-width="rightWidth")
            .cell
                .info
                    span.name 姓名：{{item.name}}
                    span.phone 电话：{{item.phone}}
                .title 意向车：{{item.title}}
            .btns(slot="right" v-if="active==0")
                span.btn.green(@click="makeDeal(item)") 成交
                span.btn.red(@click="shixiao(item)") 失效
</template>

<script>
export default {
    data () {
        return {
            active: 0,
            loading: false,
            finished: false,
            curPage: 1,
            list: []
        };
    },
    watch: {
        active (v) {
            this.research();
        }
    },
    computed: {
        rightWidth () {
            return this.active === 0 ? 120 : 0;
        }
    },
    methods: {
        research () {
            this.finished = false;
            this.list = [];
            this.curPage = 1;
            this.loading = false;
        },
        async onLoad () {
            if (!this.loading) {
                this.loading = true;
                try {
                    let { data } = await this.$http.post('/mobile/business/orderlist', {
                        is_deal: this.active,
                        p: this.curPage
                    });
                    console.log(data);
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
        },
        makeDeal (data) {
            this.$router.push({
                path: '/business/customers/deal',
                query: {
                    id: data.id
                }
            });
        },
        async shixiao (data) {
            try {
                await this.confirm('确认失效');
                await this.$http.post('/mobile/business/orderclose', {
                    id: data.id
                });
                this.success('操作成功');
                this.onLoad();
            } catch (error) {
                console.log(error);
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
                padding: 1rem 1rem;
                .info {
                    .phone {
                        padding-left: 1rem;
                    }
                }
                .title {
                    padding-top: 0.6rem;
                    color: #999;
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
