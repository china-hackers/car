<template lang="pug">
.comp-car-filter-sort-pop
    van-popup(v-model="visible" position="bottom")
        van-picker(:columns="columns" :defaultIndex="defaultIndex" :show-toolbar="true" @confirm="handleConfirm")
</template>

<script>
export default {
    data () {
        return {
            visible: false,
            defaultIndex: 0,
            columns: [
                {
                    text: '智能排序',
                    value: ''
                }, {
                    text: '首付由低到高',
                    value: 'shoufu asc'
                }, {
                    text: '首付由高到低',
                    value: 'shoufu desc'
                }, {
                    text: '月供由低到高',
                    value: 'yuegong asc'
                }, {
                    text: '月供由高到低',
                    value: 'yuegong desc'
                }, {
                    text: '车价由低到高',
                    value: 'price asc'
                }, {
                    text: '车价由高到低',
                    value: 'price desc'
                }
            ]
        };
    },
    methods: {
        open () {
            this.visible = true;
        },
        handleConfirm (value, index) {
            console.log(arguments);
            this.$emit('change', value);
            this.close();
        },
        close () {
            this.visible = false;
        }
    }
};
</script>
