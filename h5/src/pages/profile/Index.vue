<template lang="pug">
.page-profile
    .card.info
        my-avatar.avatar(:src="user.headimgurl")
        .center
            .top
                .name {{user.name || user.nickname}}
                .type {{user.itype}}
            .phone(@click="$router.push({path:'/my/bind'})")
                .text(v-if="user.phone") {{user.phone}}
                .btn(v-else) 绑定手机
            .score 我的积分：200分
        .right(@click="jumpToQr")
            van-icon.icon.qr(name="qr")
            van-icon.icon.arrow(name="arrow")
    .row
        .card.service(v-if="user.user" @click="call")
            .title 我的专属服务
            .phone
                .left
                    .name {{user.user.name}}
                    .num {{user.user.phone}}
                van-icon.icon(name="phone")
        .card.mycar(@click="addMyCar")
            template(v-if="user.car")
                .title 我的爱车
                .car-name {{user.car.model}}
            template(v-else)
                .btn 添加爱车

    .menu
        van-cell-group
            van-cell(title="我的贷款" is-link :to="{path: '/my/ioan'}")
            van-cell(title="我的车险" is-link :value="outdate" :to="{path:'/my/car-insurance'}")
            van-cell(title="我的邀请" is-link :to="{path: '/my/invite'}")
            van-cell(title="我的收藏" is-link :to="{path: '/my/collect'}")
            van-cell(title="在线服务" is-link)
            //- van-cell(title="设置" is-link)
            van-cell(title="加入爱品车" v-if="user.role==='普通'" is-link :to="{path: '/my/join'}")
            van-cell(title="车商中心" v-if="user.role==='车商'" is-link :to="{path: '/business',query:{role:user.role}}")
            van-cell(title="销售中心" v-if="user.role==='销售'" is-link :to="{path: '/business',query:{role:user.role}}")
</template>

<script>
import {call} from '@/lib/util';
export default {
    data () {
        return {
            user: {}
        };
    },
    computed: {
        outdate () {
            if (this.user.outdate) {
                return `${this.user.outdate}到期`;
            } else {
                return '';
            }
        }
    },
    methods: {
        jumpToQr () {
            this.$router.push({
                path: '/my/qr',
                query: {
                }
            });
        },
        addMyCar () {
            this.$router.push({
                path: '/my/mycar'
            });
        },
        call () {
            call(this.user.user.phone);
        },
        async getInfo () {
            try {
                let {data} = await this.$http.post('/mobile/user/user', {id: 1});
                this.user = data;
            } catch (error) {
                console.log(error);
            }
        }
    },
    created () {
        this.getInfo();
    }
};
</script>

<style lang="scss">
.page-profile {
    .van-cell__value {
        color: red;
    }
}
</style>

<style lang="scss" scoped>
.page-profile {
    padding: 1rem;
    .card {
        background-color: #f5f5f5;
        padding: 1rem;
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        &.info {
            .avatar {
                margin-right: 0.5rem;
                flex-shrink: 0;
            }
            .center {
                flex-grow: 1;
                .top {
                    display: flex;
                    align-items: center;
                    .type {
                        color: #f04c03;
                        font-size: 0.87rem;
                        margin-left: 0.5rem;
                    }
                }
                .phone {
                    color: #38f;
                    font-size: 0.87rem;
                    padding-top: 0.5rem;
                }
                .score {
                    color: #999;
                    padding-top: 0.5rem;
                    font-size: 0.87rem;
                }
            }
            .right {
                display: flex;
                align-items: center;
                .qr {
                    font-size: 2rem;
                }
                .arrow {
                    margin-left: 0.5rem;
                    color: #999;
                }
            }
        }
        &.service,
        &.mycar {
            width: 9rem;
            flex-wrap: wrap;
            justify-content: center;
            .title {
                width: 100%;
                flex-shrink: 0;
                margin-bottom: 0.5rem;
            }
            .phone {
                height: 2.2rem;
                width: 100%;
                flex-shrink: 0;
                display: flex;
                align-items: center;
                justify-content: space-between;
                color: #666;
                .num {
                    padding-top: 0.3rem;
                    color: #999;
                    font-size: 0.9rem;
                }
                .icon {
                    color: #f04c03;
                    font-size: 1.2rem;
                }
            }
            .car-name {
                width: 100%;
                color: #999;
                line-height: 2.2rem;
            }
            .btn {
                font-size: 1.2rem;
                width: 100%;
                height: 3.7rem;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
    }
    .row {
        display: flex;
        align-items: stretch;
        justify-content: space-between;
    }
}
</style>
