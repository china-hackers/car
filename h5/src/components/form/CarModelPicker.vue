<template lang="pug">
.comp-form-select
    van-cell(:class="{noval:myValue===''}" :title="label" :value="displayValue" is-link @click="show=true")
    van-popup(v-model="show" position="bottom")
        van-picker(
            :columns="columns"
            @change="handleChange"
            @confirm="handleConfirm"
            @cancel="handleCancel"
            :show-toolbar="true")
</template>

<script>
/* eslint-disable */
let index0Hash = {};
let index1Hash = {};
export default {
    props: {
        label: {
            type: String,
            default: ''
        },
        data: {
            type: Array,
            default() {
                return [];
            }
        },
        placeholder: {
            type: String,
            default: ''
        },
        value: {
            type: Number,
            default: 1
        }
    },
    watch: {
        value: {
            handler: function(v) {
                this.countValue();
            },
            immediate: true
        },
        data() {
            this.countValue();
        }
    },
    computed: {
        displayValue() {
            return this.valueText || this.placeholder;
        },
        columns() {
            let [c1, c2, c3] = [{}, {}, {}];

            c1 = {
                className: 'c1',
                defaultIndex: this.index0,
                values: this.data.map((item, index) => {
                    index0Hash[item.label] = index;
                    return item.label;
                })
            };
            let c2Data = this.data[this.index0];
            c2 = {
                className: 'c2',
                defaultIndex: this.index1,
                values: c2Data
                    ? c2Data.children.map((item, index) => {
                          index1Hash[item.label] = index;
                          return item.label;
                      })
                    : []
            };
            if (c2Data) {
                let c3Data = c2Data.children[this.index1];
                c3 = {
                    className: 'c3',
                    defaultIndex: this.index2,
                    values: c3Data
                        ? c3Data.children.map(item => {
                              return {
                                  text: item.label,
                                  value: item.value
                              };
                          })
                        : []
                };
            }
            return [c1, c2, c3];
        }
    },
    data() {
        return {
            myValue: '',
            valueText: '',
            show: false,
            index0: 0,
            index1: 0,
            index2: 0
        };
    },
    methods: {
        handleConfirm([, , c3]) {
            this.myValue = c3.value;
            this.valueText = c3.text;
            this.show = false;
            this.$emit('input', this.myValue);
        },
        handleCancel() {
            this.show = false;
        },
        handleChange(picker, [c1, c2, c3]) {
            this.index0 = index0Hash[c1];
            this.index1 = index1Hash[c2];
        },
        countValue() {
            if (this.data.length) {
                this.data.forEach((letter, index0) => {
                    letter.children.forEach((brand, index1) => {
                        brand.children.forEach((model, index2) => {
                            if (model.value === this.value) {
                                this.index0 = index0;
                                this.index1 = index1;
                                this.index2 = index2;
                                this.valueText = model.label;
                            }
                        });
                    });
                });
            }
        }
    }
};
</script>
<style lang="scss">
.comp-form-select {
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
}
</style>
