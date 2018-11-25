<template lang="pug">
    .upload-button
        el-upload(class="upload-box"
                action="/index.php?c=Uploader&ajax=1&module=admin"
                name="thefile"
                :show-file-list="false"
                :on-success="handleSuccess"
                :before-upload="beforeUpload")
            .imgBox(v-if="imgInfo" :style="'backgroundImage:url('+imgInfo+')'")
            i(v-else class="el-icon-plus uploader-icon")
</template>

<script>
export default {
    props: {
        index: {
            type: Number
        },
        imgInfo: {
            type: String
        }
    },
    methods: {
        handleSuccess (res, file) {
            if (res.type === 'succ') {
                let index = this.index;
                this.$parent.imgs[index].image = res.msg[0].original.fileurl;
                this.$parent.imgs[index].width = res.msg[0].original.width;
                this.$parent.imgs[index].height = res.msg[0].original.height;
            } else {
                this.error(res.msg);
            }
        },
        beforeUpload (file) {
            const isJPG = file.type === 'image/jpeg';
            const isLt2M = file.size / 1024 / 1024 < 2;

            if (!isJPG) {
                this.$message.error('上传图片只能是 JPG 格式!');
            }
            if (!isLt2M) {
                this.$message.error('上传图片大小不能超过 2MB!');
            }
            return isJPG && isLt2M;
        }
    }
};
</script>

<style lang="scss" scoped>
.upload-button {
    .upload-box {
        width: 240px;
        height: 200px;
        .el-upload {
            cursor: pointer;
        }
        .imgBox {
            width: 240px;
            height: 200px;
            margin: 0 auto;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        .uploader-icon {
            font-size: 28px;
            color: #8c939d;
            width: 240px;
            height: 200px;
            line-height: 200px;
            text-align: center;
        }
    }
}
</style>
