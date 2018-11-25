<template lang="pug">
.comp
    .item.flex(v-for="(item, index) in list")
        el-input.key(:placeholder="placeholder1" v-model="item.key")
        el-input-number.val(:min="0" :precision="0" :placeholder="placeholder2" v-model="item.val")
        el-button.btn(type="primary" @click="add" v-if="index===list.length-1") 新增
        el-button.btn(type="danger" @click="del(index)") 删除
</template>

<script>
export default {
    props: {
        placeholder1: {
            type: String,
            default: '请输入保险项目'
        },
        placeholder2: {
            type: String,
            default: '请输入金额'
        },
        value: {
            type: Array,
            default () {
                return [];
            }
        }
    },
    watch: {
        value: {
            handler (v) {
                if (v.length) {
                    this.list = v;
                } else {
                    this.list = [{key: '', val: ''}];
                }
            },
            immediate: true
        }
    },
    data () {
        return {
            list: []
        };
    },
    methods: {
        add () {
            this.list.push({
                key: '',
                val: ''
            });
            this.$emit('input', this.list);
        },
        del (index) {
            this.list.splice(index, 1);
            this.$emit('input', this.list);
        }
    }
};
</script>

<style lang="scss" scoped>
.comp {
    .item {
        margin-bottom: 10px;
        .key {
            width: 200px;
            margin-right: 20px;
        }
        .val {
            width: 200px;
            margin-right: 20px;
        }
    }
}
</style>
