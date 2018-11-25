<template lang="pug">
.comp-car-filter-other-pop
    van-popup.popup-wrap(v-model="visible" position="right")
        .list
            .item
                .title 排量
                .sub-items
                    .sub-item(
                        v-for="(item, index) in displacementList"
                        :class="{choosed:index===displacementIndex}"
                        @click="setValue('displacement',index,item.from,item.to)")
                        | {{item.text}}
            .item
                .title 变速箱
                .sub-items
                    .sub-item(
                        v-for="(item, index) in gear_boxList"
                        :class="{choosed:index===gear_boxIndex}"
                        @click="setValue2('gear_box',index,item)")
                        | {{item}}
            .item
                .title 进气形式
                .sub-items
                    .sub-item(
                        v-for="(item, index) in air_inList"
                        :class="{choosed:index===air_inIndex}"
                        @click="setValue2('air_in',index,item)")
                        | {{item}}
            //- .item
            //-     .title 能源
            //-     .sub-items
            //-         .sub-item 汽油
            //-         .sub-item 油电混合
        my-bottom-bar.btns.flex
            .left(@click="close") 取消
            .right(@click="view") 查看
</template>

<script>
export default {
    data () {
        return {
            visible: false,
            displacementIndex: '',
            gear_boxIndex: '',
            air_inIndex: '',
            displacement_from: '',
            displacement_to: '',
            gear_box: '',
            air_in: '',
            displacementList: [
                {
                    from: 0,
                    to: 1,
                    text: '1.0以下'
                }, {
                    from: 1,
                    to: 2,
                    text: '1.0-2.0'
                }, {
                    from: 2,
                    to: 3,
                    text: '2.0-3.0'
                }, {
                    from: 3,
                    to: 4,
                    text: '3.0-4.0'
                }, {
                    from: 4,
                    to: 0,
                    text: '4.0以上'
                }
            ],
            gear_boxList: [ '手动', '自动' ],
            air_inList: [ '自然吸气', '涡轮增压' ]
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
        setValue2 (key, index, value) {
            this[`${key}Index`] = index;
            this[`${key}`] = value;
        },
        view () {
            this.$emit('change', {
                displacement_from: this.displacement_from,
                displacement_to: this.displacement_to,
                gear_box: this.gear_box,
                air_in: this.air_in
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
.comp-car-filter-other-pop {
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
