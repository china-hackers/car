<template lang="pug">
.comp-image-list-uploader
    .item.bg-image(v-for="el in 5")
        el-button.close(type="text" icon="el-icon-close" size="mini")
    el-upload(class="avatar-uploader"
            action="/index.php?c=Uploader&ajax=1&module=admin"
            name="thefile"
            :show-file-list="false"
            :on-success="handleAvatarSuccess"
            :before-upload="beforeAvatarUpload")
        i(class="el-icon-plus avatar-uploader-icon")
</template>

<script>

export default {
    data () {
        return {
            list: []
        };
    },
    methods: {
        handleAvatarSuccess (res, file) {
            if (res.type === 'succ') {
                this.$emit('get-size', {
                    width: res.msg[0].original.width,
                    height: res.msg[0].original.height
                });
                this.$emit('input', res.msg[0].original.file);
            } else {
                this.error(res.msg);
            }
        },
        beforeAvatarUpload (file) {
            const isJPG = file.type === 'image/jpeg';
            const isLt2M = file.size / 1024 / 1024 < 2;

            if (!isJPG) {
                this.$message.error('上传头像图片只能是 JPG 格式!');
            }
            if (!isLt2M) {
                this.$message.error('上传头像图片大小不能超过 2MB!');
            }
            return isJPG && isLt2M;
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-image-list-uploader {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    .item {
        width: 200px;
        height: 200px;
        margin: 0 10px 10px 0;
        position: relative;
        .close {
            position: absolute;
            right: 5px;
            top: 0;
        }
    }
    .avatar-uploader {
        .avatar-uploader-icon {
            font-size: 28px;
            color: #8c939d;
            width: 200px;
            height: 200px;
            line-height: 200px;
            background: #f2f2f2;
            text-align: center;
        }
    }
}
</style>
