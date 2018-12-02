<template lang="pug">
.van-cell.comp-form-select(:class="{noval:myValue===''}" @click="show=true")
    .van-cell__title
        span {{label}}
    .van-cell__value
        van-uploader(:after-read="onRead" accept="image/*")
            span {{displayValue}}
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
        },
        value: {
            type: String,
            default: ''
        }
    },
    watch: {
        value(v) {
            this.myValue = v;
        }
    },
    computed: {
        displayValue() {
            return this.myValue || this.placeholder;
        }
    },
    data() {
        return {
            myValue: '',
            show: false
        };
    },
    methods: {
        async onRead(file) {
            try {
                let param = new FormData(); // 创建form对象
                param.append('UploadModel[image]', file.file); // 通过append向form对象添加数据
                let config = {
                    headers: { 'Content-Type': 'multipart/form-data' }
                }; // 添加请求头
                let { data } = await this.$http.post(
                    '/mobile/site/safeimg',
                    param,
                    config
                );
                this.myValue = data[0];
            } catch (error) {
                console.log(error);
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
