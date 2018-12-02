<template lang="pug">
.page-car-detail
    my-nav-bar(title="车辆详情")
    my-banner(:list="imgs")
    .base-info
        .title {{product.title}}
        .info 成都 {{product.reg_date}}上牌 {{product.km}}万公里 {{product.emission_std}}
        .cur-price {{product.price}}万元
        .origin-price 官方指导价：{{product.price_new}}万+{{product.tax}}万（购置税）
    my-box
        .dealer
            .name {{product.business}}
            .number 共有好车{{product.business_cars}}辆
            //- .phone
            //-     .text.onerow {{business.phone}}
            //-     van-icon.icon(name="phone")
            //- .location
            //-     .text.onerow {{business.address}}
            //-     van-icon.icon(name="location")
            //- .audio
            //-     .text 车商有话说:
            //-     .voice
            //-         i.iconfont &#xe628;
            //-         span 1:12
    my-box
        my-title(title="车辆信息" :showRight="true" rightText="更多参数配置" @right-click="showMoreParams")
        my-key-value(:list="baseParams")
        .tips 参数配置仅供参考，下单前请与销售确认
    my-box
        my-title(title="车辆描述")
        .desc
            .title [检测师说]
            .content {{evaluate.examiner}}
            .title [车主说]
            .content {{evaluate.owner}}
            .title [车商说]
            .content {{evaluate.business}}
    my-box
        my-title(title="车辆网络口碑" :showRight="true")
        .prize
            .score 综合评分：{{star}}分
            .tags
                .item(v-for="item in koubei") {{item}}
    my-box
        my-title(title="车辆实拍")
        .imgs
            img(v-for="(item, index) in imgs" v-lazy="item.img" @click="previewImg(index)")
    my-bottom-bar.bottom
        .item.phone
            van-icon.icon(name="phone")
            .right
                .text 电话咨询
                .time 9:00-21:00
        .item.collect(@click="collect" :class="{done: isCollected===1}")
            van-icon.icon(name="like")
            .right {{isCollected===1?'已收藏':'收藏'}}
        .item.form(@click="jumpToFrom")
            | 询最低价
</template>

<script>
import { ImagePreview } from 'vant';
export default {
    data() {
        return {
            id: '',
            product: {},
            base: {},
            evaluate: {},
            star: '',
            koubei: {},
            imgs: [],
            isCollected: 0
        };
    },
    computed: {
        baseParams() {
            return [
                {
                    key: '车门数',
                    val: this.base.doors
                },
                {
                    key: '座位数',
                    val: this.base.chairs
                },
                {
                    key: '长宽高(mm)',
                    val: `${this.base.length}/${this.base.width}/${
                        this.base.height
                    }`
                },
                {
                    key: '轴距(mm)',
                    val: this.base.wheelbase
                },
                {
                    key: '行李箱容积(L)',
                    val: this.base.capacity
                },
                {
                    key: '整备质量(KG)',
                    val: this.base.weight
                },
                {
                    key: '颜色',
                    val: this.base.color
                },
                {
                    key: '变速箱',
                    val: this.base.gear_box
                },
                {
                    key: '变速箱型号',
                    val: this.base.gear_model
                },
                {
                    key: '车型',
                    val: this.base.model
                },
                {
                    key: '轮毂',
                    val: this.base.wheel
                }
            ];
        }
    },
    methods: {
        showMoreParams() {
            this.$router.push({
                path: '/car/param',
                query: {
                    id: this.id
                }
            });
        },
        jumpToFrom() {
            this.$router.push({
                path: '/car/form',
                query: {
                    id: this.id
                }
            });
        },
        previewImg(index) {
            ImagePreview({
                images: this.imgs.map(item => item.img),
                startPosition: index
            });
        },
        async collect() {
            try {
                let { data } = await this.$http.post('/mobile/product/store', {
                    pid: this.id,
                    store: this.isCollected === 1 ? 0 : 1
                });
                this.$dialog.alert({
                    message: '操作成功'
                });
                this.isCollected = data.store;
            } catch (error) {
                console.log(error);
            }
        },
        async getImgs() {
            try {
                let { data } = await this.$http.post('/mobile/product/img', {
                    id: this.id,
                    p: 1
                });
                this.imgs = data.list;
            } catch (error) {
                console.log(error);
            }
        },
        async getEvaluate() {
            try {
                let { data } = await this.$http.post('/mobile/product/info', {
                    id: this.id
                });
                this.evaluate = data;
            } catch (error) {
                console.log(error);
            }
        },
        async getBase() {
            try {
                let { data } = await this.$http.post('/mobile/product/base', {
                    id: this.id
                });
                this.base = data;
            } catch (error) {
                console.log(error);
            }
        },
        async getProduct() {
            try {
                let { data } = await this.$http.post(
                    '/mobile/product/product',
                    {
                        id: this.id
                    }
                );
                this.product = data;
            } catch (error) {
                console.log(error);
            }
        },
        async getKoubei() {
            try {
                let { data } = await this.$http.post('/mobile/product/koubei', {
                    id: this.id
                });
                this.koubei = data.keywords;
                this.star = data.star;
            } catch (error) {
                console.log(error);
            }
        },
        async getCollectStatus() {
            try {
                let { data } = await this.$http.post('/mobile/product/store', {
                    pid: this.id,
                    store: 2
                });
                this.isCollected = data.store;
            } catch (error) {
                console.log(error);
            }
        }
    },
    created() {
        this.id = this.$route.query.id;
        this.getImgs();
        this.getEvaluate();
        this.getBase();
        this.getProduct();
        this.getKoubei();
        this.getCollectStatus();
    }
};
</script>

<style lang="scss" scoped>
.page-car-detail {
    .base-info {
        padding: 1rem;
        .title {
            font-size: 1.2rem;
            line-height: 1.4rem;
        }
        .info {
            color: #999;
            padding-top: 0.5rem;
        }
        .cur-price {
            font-size: 2rem;
            color: #f04c03;
            line-height: 2rem;
            padding: 0.8rem 0;
        }
        .origin-price {
            color: #999;
        }
    }
    .dealer {
        padding: 1rem;
        .name {
            font-size: 1.2rem;
            line-height: 1.4rem;
        }
        .number {
            color: #999;
            font-size: 0.87rem;
            padding: 0.5rem 0 0;
            // border-bottom: 1px solid #f5f5f5;
        }
        .phone,
        .location {
            padding: 1rem 0;
            border-bottom: 1px solid #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            .text {
                width: 20rem;
            }
            .icon {
                flex-shrink: 0;
                color: #f04c03;
            }
        }
        .audio {
            padding-top: 1rem;
            display: flex;
            align-items: center;
            .voice {
                width: 8rem;
                border: 1px solid #ccc;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0.4rem 0.4rem;
                border-radius: 0.2rem;
                margin-left: 1rem;
                i {
                    color: #f04c03;
                }
            }
        }
    }
    .tips {
        color: red;
        padding: 1.5rem;
    }
    .desc {
        padding: 0 1rem 1rem 2rem;
        .title {
            padding: 0.5rem 0;
            font-weight: bold;
        }
        .content {
            line-height: 1.4rem;
        }
    }
    .prize {
        padding: 0 1rem 1rem 2rem;
        .score {
            padding: 0 0 0.5rem;
            font-weight: bold;
            color: rgb(37, 155, 36);
        }
        .tags {
            display: flex;
            align-items: flex-start;
            flex-wrap: wrap;
            .item {
                font-size: 0.87rem;
                padding: 0.3rem 0.6rem;
                background-color: rgb(37, 155, 36);
                color: #fff;
                margin-right: 0.5rem;
                margin-bottom: 0.5rem;
            }
        }
    }
    .imgs {
        padding: 0 1rem 1rem 1rem;
        img {
            width: 100%;
            display: block;
            margin-bottom: 1rem;
            &:last-child {
                margin-bottom: 0;
            }
        }
    }
    .bottom {
        .item {
            width: 33.33%;
        }
        .phone,
        .collect {
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-right: 1px solid #eee;
            .right {
                font-size: 0.87rem;
                margin-left: 0.5rem;
            }
            &.done {
                color: #f04c03;
            }
        }
        .form {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
    }
}
</style>
