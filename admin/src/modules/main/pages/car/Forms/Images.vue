<template lang="pug">
.comp-images
    .item.bg-image(v-for="(item, index) in list" v-bgsrc="item.img")
        el-button.close(type="text" icon="el-icon-close" size="mini" @click="deleteImage(item, index)")
    el-upload(class="avatar-uploader"
            action="/admin/site/productimg"
            name="UploadModel[images][]"
            accept="image/*"
            :data="uploadData"
            :multiple="true"
            :show-file-list="false"
            :on-success="onUploadSuccess"
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
    computed: {
        uploadData () {
            return {
                id: this.$route.query.id
            };
        }
    },
    methods: {
        async deleteImage (item, index) {
            try {
                await this.$confirm('确认删除？');
                await this.$http.post('/admin/product/imgdelete', {
                    img_id: item.id
                });
                this.success('删除成功');
                this.list.splice(index, 1);
            } catch (error) {
                console.log(error);
            }
        },
        onUploadSuccess (res, file) {
            if (res.code === 200) {
                // this.list.push({
                //     id: res.data[0][0],
                //     img: res.data[0][1]
                // });
                res.data.forEach(item => {
                    this.list.push({
                        id: item[0],
                        img: item[1]
                    });
                });
            } else {
                this.error('图片过大，限制10M以内');
            }
        },
        beforeAvatarUpload (file) {
            // const isJPG = file.type === 'image/jpeg';
            // const isLt2M = file.size / 1024 / 1024 < 2;

            // if (!isJPG) {
            //     this.$message.error('上传头像图片只能是 JPG 格式!');
            // }
            // if (!isLt2M) {
            //     this.$message.error('上传头像图片大小不能超过 2MB!');
            // }
            // return isJPG && isLt2M;
        },
        async getInfo () {
            try {
                let { data } = await this.$http.post('/admin/product/img', {
                    id: this.$route.query.id
                });
                this.list = data.data.list;
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted () {
        this.getInfo();
    }
};
</script>

<style lang="scss" scoped>
.comp-images {
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
