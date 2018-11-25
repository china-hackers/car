<template lang="pug">
.comp
    van-cell(:class="{noval:myValue===''}" :title="label" :value="displayValue" is-link @click="show=true")
    van-popup.pop(v-model="show" position="right")
        van-nav-bar(:fixed="true" title="选择车辆" left-text="返回" left-arrow @click-left="handleLeftClick")
        van-search(placeholder="请输入车辆标题" v-model="searchText" @search="research")
        van-list.list(:loading="loading" :finished="finished" @load="onLoad" :offset="600")
            van-swipe-cell.item(v-for="(item, index) in list" :key="item.id")
                .cell.flex
                    .cover.bg(v-lazy:background-image="item.img")
                    .info
                        .title {{item.title}}
                        .btns
                            van-button(size="mini" type="primary" @click="onSelect(item)") 选择

</template>

<script>
export default {
    props: {
        label: {
            type: String,
            default: ''
        },
        placeholder: {
            type: String,
            default: ''
        }

    },
    computed: {
        displayValue () {
            return this.valueText || this.placeholder;
        }
    },
    data () {
        return {
            myValue: '',
            valueText: '',
            show: false,
            searchText: '',
            loading: false,
            finished: false,
            curPage: 1,
            list: []
        };
    },
    methods: {
        onSelect (item) {
            this.myValue = item.id;
            this.valueText = item.title;
            this.show = false;
            this.$emit('input', this.myValue);
        },
        handleLeftClick () {
            this.show = false;
        },
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
                    let { data } = await this.$http.post('/mobile/business/productlist', {
                        state: 0,
                        p: this.curPage,
                        title: this.searchText
                    });
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
<style lang="scss" scoped>
.comp {
    padding: 0;
    position: relative;
    &::after {
        content: ' ';
        position: absolute;
        pointer-events: none;
        box-sizing: border-box;
        left: 15px;
        right: 0;
        bottom: 0;
        -webkit-transform: scaleY(0.5);
        transform: scaleY(0.5);
        border-bottom: 1px solid #eee;
    }
    .noval {
        .van-cell__value {
            color: rgb(117, 117, 117);
        }
    }
    .van-cell__title {
        max-width: 90px;
    }
    .van-cell__value {
        text-align: left;
    }
    .pop {
        width: 100%;
        height: 100%;
        box-sizing: border-box;
        padding-top: 46px;
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
                width: 180px;
                height: 100%;
                display: flex;
                align-items: stretch;
            }
        }
    }
}
</style>
