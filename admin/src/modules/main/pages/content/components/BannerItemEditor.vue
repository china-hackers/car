<template lang="pug">
el-dialog(title="新增幻灯" :visible.sync="visible" width="800px")
    .comp-banner-item-editor
        el-form(label-width="120px" label-position="left")
            el-form-item(label="图片(1125*630)")
                my-image.image(v-if="form.img" :src="form.img" name="UploadModel[image]")
                el-upload(class="uploader"
                    action="/admin/site/bannerimg"
                    name="UploadModel[image]"
                    accept="image/*"
                    :multiple="false"
                    :show-file-list="false"
                    :on-success="onUploadSuccess")
                    i(class="el-icon-plus uploader-icon")
            el-form-item(label="到期时间")
                el-date-picker(type="date" v-model="form.outdate" value-format="yyyy-MM-dd")
            el-form-item(label="链接")
                el-input(v-model="form.url")
            el-form-item(label="")
                my-button(type="primary" :click="save") 保存
</template>

<script>
import dialogMixin from '@/mixins/dialog';
export default {
    mixins: [dialogMixin],
    components: {},
    data() {
        return {
            form: {
                img: '',
                outdate: '',
                url: ''
            }
        };
    },
    methods: {
        onUploadSuccess(res, file) {
            if (res.code === 200) {
                this.form.img = res.data[0];
            } else {
                this.error('图片过大，限制10M以内');
            }
        },
        clear() {
            this.form = {
                img: '',
                outdate: '',
                url: ''
            };
        },
        setData(data) {
            this.form = {
                id: data.id,
                img: data.img,
                outdate: data.outdate,
                url: data.url
            };
        },
        async save() {
            try {
                await this.$http.post('/admin/banner/save', this.form);
                this.success('保存成功');
                this.$emit('save-success');
                this.close();
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-banner-item-editor {
    width: 500px;
    padding-left: 40px;
    .el-checkbox {
        margin-left: 0;
        margin-right: 30px;
        &:last-child {
            margin-right: 0;
        }
    }
    .image {
        width: 100px;
        height: 100px;
        margin: 0;
        display: inline-block;
        vertical-align: top;
        margin-right: 20px;
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
