<template lang="pug">
.comp-form-select
    van-cell(:class="{noval:myValue===''}" :title="label" :value="displayValue" is-link @click="show=true")
    van-actionsheet(v-model="show" :actions="actions" @select="onSelect")
</template>

<script>
export default {
    props: {
        label: {
            type: String,
            default: ''
        },
        actions: {
            type: Array,
            default () {
                return [
                    {name: '1'}
                ];
            }
        },
        placeholder: {
            type: String,
            default: ''
        },
        value: {
            type: String,
            default: ''
        }
    },
    watch: {
        value: {
            handler (v) {
                let find = this.actions.find(item => {
                    return item.value === v;
                });
                if (find) {
                    this.myValue = find.value;
                    this.valueText = find.name;
                }
            },
            immediate: true
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
            show: false
        };
    },
    methods: {
        onSelect (item) {
            this.myValue = item.value;
            this.valueText = item.name;
            this.show = false;
            this.$emit('input', this.myValue);
        }
    }
};
</script>
<style lang="scss">
.comp-form-select {
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
}
</style>
