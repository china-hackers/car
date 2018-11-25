<template lang="pug">
.page
    my-nav-bar(title="车辆图片" right-icon="info-o" @right-click="guide=true")
    .wrap
        .item.bg(v-for="(item, index) in list" @click="preview(index)" v-lazy:background-image="item.img")
            van-icon.icon(name="close" @click.stop.prevent="delItem(item, index)")
        van-uploader(:after-read="onRead")
            .item.upload
                van-icon(name="photograph" size="2rem")
    .guide(v-if="guide" @click="hideGuide")
        .img.bg
        van-icon.close(name="close")
</template>

<script>
import carEditMixin from '../mixins/carEdit';
export default {
    mixins: [carEditMixin],
    data () {
        return {
            guide: true,
            list: []
        };
    },
    methods: {
        async onRead (file) {
            console.log(file);
            try {
                this.loading.show('上传中...');
                let param = new FormData(); // 创建form对象
                param.append('UploadModel[images][]', file.file);// 通过append向form对象添加数据
                param.append('id', this.$route.query.id);
                let config = {
                    headers: {'Content-Type': 'multipart/form-data'}
                }; // 添加请求头
                let { data } = await this.$http.post('/admin/site/productimg', param, config);
                console.log(data);
                this.list.push({
                    id: data[0][0],
                    img: data[0][1]
                });
            } catch (error) {
                console.log(error);
            }
            this.loading.clear();
        },
        async delItem (item, index) {
            try {
                await this.confirm('确认删除？');
                await this.$http.post('/mobile/product/imgdelete', {
                    img_id: item.id
                });
                this.success('删除成功');
                this.list.splice(index, 1);
            } catch (error) {
                console.log(error);
            }
        },
        preview (index) {
            this.ImagePreview({
                images: this.list.map(item => item.img),
                startPosition: index
            });
        },
        hideGuide () {
            this.guide = false;
        }
    },
    async created () {
        try {
            let { data } = await this.$http.post('/mobile/product/img', {
                id: this.$route.query.id
            });
            this.list = data.list;
        } catch (error) {
            console.log(error);
        }
    }
};
</script>

<style lang="scss" scoped>
.page {
    .guide {
        position: fixed;
        flex-wrap: wrap;
        flex-direction: column;
        display: flex;
        align-items: center;
        justify-content: center;
        left: 0;
        right: 0;
        top: 46px;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        .img {
            width: 20rem;
            height: 27.4rem;
            background-image: url(../../../assets/img_guide.jpeg);
        }
        .close {
            color: #fff;
            font-size: 2rem;
            margin-top: 1rem;
        }
    }
    .wrap {
        display: flex;
        flex-wrap: wrap;
        .item {
            width: 7rem;
            height: 7rem;
            margin: 1rem 0 0 1rem;
            background-color: #ccc;
            position: relative;
            .icon {
                position: absolute;
                right: 0.2rem;
                top: 0.2rem;
                color: #f04c03;
            }
            &.upload {
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
    }
}
</style>
