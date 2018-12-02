<template lang="pug">
.comp
    el-form-item(:label="label")
        my-image.image(v-for="(item,index) in list" :src="item" :key="item")
            el-button.close(type="text" icon="el-icon-close" size="mini" @click.prevent.stop="deleteImage(item, index)")
        el-upload(class="uploader"
            :action="action"
            :name="name"
            accept="image/*"
            :multiple="multiple"
            :show-file-list="false"
            :on-error="handleUploadError"
            :on-success="onUploadSuccess")
            i(class="el-icon-plus uploader-icon")
</template>

<script>
export default {
    props: {
        label: {
            type: String,
            default: ''
        },
        size: {
            type: Number,
            default: 1
        },
        name: {
            type: String,
            default: 'UploadModel[images][]'
        },
        action: {
            type: String,
            default: ''
        },
        value: ''
    },
    watch: {
        value: {
            handler(v) {
                if (typeof v === 'string') {
                    this.list = [v];
                } else {
                    this.list = v;
                }
            },
            immediate: true
        }
    },
    computed: {
        multiple() {
            return this.size > 1;
        }
    },
    data() {
        return {
            list: []
        };
    },
    methods: {
        onUploadSuccess(data) {
            console.log(data);
            if (data.code !== 200) {
                this.error('文件过大，限制10M以内');
            } else {
                if (this.size === 1) {
                    this.list = data.data;
                    this.$emit('input', this.list[0]);
                } else {
                    data.data.forEach(item => {
                        this.list.push(item);
                    });
                    this.$emit('input', this.list);
                }
            }
        },
        deleteImage(item, index) {
            this.list.splice(index, 1);
            this.$emit('input', this.list);
        },
        handleUploadError() {}
    }
};
</script>

<style lang="scss" scoped>
.comp {
    .image {
        width: 100px;
        height: 100px;
        margin: 0;
        display: inline-block;
        vertical-align: top;
        margin-right: 10px;
        margin-bottom: 10px;
        position: relative;
        .close {
            position: absolute;
            right: 5px;
            top: 0;
        }
    }
    .uploader {
        display: inline-block;
        vertical-align: top;
        .uploader-icon {
            font-size: 28px;
            color: #8c939d;
            width: 100px;
            height: 100px;
            line-height: 100px;
            background: #f2f2f2;
            text-align: center;
        }
    }
}
</style>
