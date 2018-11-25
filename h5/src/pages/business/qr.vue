<template lang="pug">
.page
    my-nav-bar(title="我的二维码")
    .cont
        .usertype 尊敬的客户
        .desc
            p 加入I品车，更多车源更多客户
        .qr
            img(v-lazy="qr")
        .tips 识别二维码，加入I品车
</template>

<script>
export default {
    data () {
        return {
            qr: ''
        };
    },
    async created () {
        try {
            let {data} = await this.$http.post('/mobile/business/qrcode', {p: 1});
            this.qr = data.qrcode;
        } catch (error) {
            console.log(error);
        }
    }
};
</script>

<style lang="scss" scoped>
.page {
    height: 100%;
    .cont {
        margin: 1rem 1rem 0;
        background-color: #fff;
        border-radius: 0.27rem;
        padding: 1rem 1rem 4rem 1rem;
        text-align: center;
        position: relative;
        border: 1px solid #eee;
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
                width: 8rem;
                height: 8rem;
                background-color: #ccc;
            }
        }
    }
}
</style>
