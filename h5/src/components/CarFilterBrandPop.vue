<template lang="pug">
.comp-car-filter-brand-pop
    van-popup.popup-wrap(v-model="visible" position="right")
        van-radio-group(v-model="brand")
            .list
                .item(v-for="item in brands")
                    .title {{item.letter}}
                    .sub-items
                        .sub-item(v-for="(brand, index) in item.list" :key="index")
                            van-radio(:name="brand") {{brand}}
        my-bottom-bar.btns.flex
            .left(@click="cancel") 取消
            .right(@click="choose") 查看
</template>

<script>
import { mapState } from 'vuex';
export default {
    props: {
        value: {
            props: {
                type: String,
                default: ''
            }
        }
    },
    watch: {
        value: {
            handler () {
                this.brand = this.value;
            },
            immediate: true
        }
    },
    data () {
        return {
            brand: '',
            visible: false
        };
    },
    computed: {
        ...mapState({
            brands: state => state.brands
        })
    },

    methods: {
        open () {
            this.visible = true;
        },
        choose () {
            this.$emit('input', this.brand);
            this.$emit('change');
            this.visible = false;
        },
        cancel () {
            this.visible = false;
            this.brand = '';
            this.$emit('input', this.brand);
            this.$emit('change');
        }
    },
    async created () {

    }
};
</script>

</<style lang="scss" scoped>
.comp-car-filter-brand-pop {
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
            height: calc(100vh - 50px);
            overflow: auto;
            .title {
                padding: 0.5rem 1rem;
                background: #f5f5f5;
                color: #999;
            }
            .sub-items {
                padding: 0.5rem 0;
            }
            .sub-item {
                padding: 0.5rem 1rem;
            }
        }
    }
}
</style>
