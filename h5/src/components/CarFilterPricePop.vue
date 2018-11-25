<template lang="pug">
.comp-car-filter-price-pop
    van-popup.popup-wrap(v-model="visible" position="right")
        .list
            .item
                .title 首付
                .sub-items
                    .sub-item(v-for="(item, index) in shoufuList" :class="{choosed:index===shoufuIndex}" @click="setValue('shoufu',index,item.from,item.to)") {{item.text}}
            .item
                .title 月供
                .sub-items
                    .sub-item(v-for="(item, index) in yuegongList" :class="{choosed:index===yuegongIndex}" @click="setValue('yuegong',index,item.from,item.to)") {{item.text}}
            .item
                .title 指导价
                .sub-items
                    .sub-item(v-for="(item, index) in priceList" :class="{choosed:index===priceIndex}" @click="setValue('price',index,item.from,item.to)") {{item.text}}
        my-bottom-bar.btns.flex
            .left(@click="close") 取消
            .right(@click="view") 查看
</template>

<script>
export default {
    data () {
        return {
            visible: false,
            shoufuIndex: '',
            yuegongIndex: '',
            priceIndex: '',
            shoufu_from: '',
            shoufu_to: '',
            yuegong_from: '',
            yuegong_to: '',
            price_from: '',
            price_to: '',
            shoufuList: [
                {
                    from: 0,
                    to: 10000,
                    text: '1万以内'
                }, {
                    from: 10000,
                    to: 20000,
                    text: '1-2万'
                }, {
                    from: 20000,
                    to: 30000,
                    text: '2-3万'
                }, {
                    from: 30000,
                    to: 40000,
                    text: '3-4万'
                }, {
                    from: 40000,
                    to: 0,
                    text: '4万以上'
                }
            ],
            yuegongList: [{
                from: 0,
                to: 1000,
                text: '1千以内'
            }, {
                from: 1000,
                to: 2000,
                text: '1-2千'
            }, {
                from: 2000,
                to: 3000,
                text: '2-3千'
            }, {
                from: 3000,
                to: 4000,
                text: '3-4千'
            }, {
                from: 4000,
                to: 0,
                text: '4千以上'
            } ],
            priceList: [{
                from: 0,
                to: 5,
                text: '5万以下'
            }, {
                from: 5,
                to: 8,
                text: '5-8万'
            }, {
                from: 8,
                to: 12,
                text: '8-12万'
            }, {
                from: 12,
                to: 18,
                text: '12-18万'
            }, {
                from: 18,
                to: 25,
                text: '18-25万'
            }, {
                from: 25,
                to: 40,
                text: '25-40万'
            }, {
                from: 40,
                to: 0,
                text: '40万以上'
            } ]
        };
    },
    methods: {
        open () {
            this.visible = true;
        },
        setValue (key, index, from, to) {
            this[`${key}Index`] = index;
            this[`${key}_from`] = from;
            this[`${key}_to`] = to;
        },
        view () {
            this.$emit('change', {
                shoufu_from: this.shoufu_from,
                shoufu_to: this.shoufu_to,
                yuegong_from: this.yuegong_from,
                yuegong_to: this.yuegong_to,
                price_from: this.price_from,
                price_to: this.price_to
            });
            this.close();
        },
        close () {
            this.visible = false;
        }
    }
};
</script>

</<style lang="scss" scoped>
.comp-car-filter-price-pop {
    width: 100%;
    height: 100%;
    .popup-wrap {
        width: 100%;
        height: 100%;
        .btns {
            .left, .right {
                width:50%;
                text-align:center;
                line-height: 50px;
                color:#fff;
            }
            .left {
                background-color:#f5f5f5;
                color:#999;
            }
        }
        .list {
            height: calc(100% - 50px);
            overflow: auto;
            .title {
                padding: 1rem;
                color: #333;
            }
            .sub-items {
                padding: 0 1rem 0;
                display: flex;
                align-items: center;
                flex-wrap: wrap;
                .sub-item {
                    padding: 0.6rem 1rem;
                    background-color: #f1f1f1;
                    color: #999;
                    flex-shrink: 0;
                    margin: 0 1rem 1rem 0;
                    &.choosed {
                        color: #fff;
                        background-color: #e86352;
                    }
                }
            }

        }
    }
}
</style>
