<template lang="pug">
.page-qr
    my-nav-bar(title="我的二维码")
    .cont
        my-avatar.avatar(:src="user.headimgurl")
        .name {{user.name}}
        .usertype {{user.itype}}尊享客户
        .desc
            p 加入I品车，更多车源更多客户
        .qr
            img(v-lazy="qr")
        .tips 识别二维码，加入I品车
</template>

<script>
export default {
    data() {
        return {
            qr: '',
            user: {}
        };
    },
    methods: {
        async getUser() {
            try {
                let { data } = await this.$http.post('/mobile/user/user', {
                    id: 1
                });
                this.user = data;
            } catch (error) {
                console.log(error);
            }
        }
    },
    async created() {
        try {
            let { data } = await this.$http.post('/mobile/user/qrcode', {
                p: 1,
                id: this.$route.query.id
            });
            this.qr = data.qrcode;
            this.getUser();
        } catch (error) {
            console.log(error);
        }
    }
};
</script>

<style lang="scss" scoped>
.page-qr {
    height: 100%;
    background-color: rgb(241, 128, 54);
    .cont {
        margin: 6rem 1rem 0;
        background-color: #fff;
        border-radius: 0.27rem;
        padding: 1rem 1rem 4rem 1rem;
        text-align: center;
        position: relative;
        .avatar {
            position: absolute;
            left: 9.5rem;
            top: -2rem;
        }
        .name {
            color: rgb(241, 128, 54);
            padding-top: 2rem;
            font-size: 1.2rem;
            line-height: 100%;
        }
        .usertype {
            color: #999;
            padding: 1rem 0;
            font-weight: bold;
        }
        .desc {
            color: #999;
            font-size: 0.87rem;
            line-height: 1.5rem;
        }
        .qr {
            padding: 1rem 0;
            img {
                margin: 0 auto;
                display: block;
                width: 10rem;
                height: 10rem;
                background-color: #ccc;
            }
        }
    }
}
</style>
