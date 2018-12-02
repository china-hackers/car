<template lang="pug">
.page-car-insurance
    my-nav-bar(title="我的车险")
    van-cell-group
        van-cell(title="车险项目" is-link arrow-direction="down")
        my-key-value(:list="data.options")
        van-cell(title="车险总价" :value="`${data.d_price}元`")
        van-cell(title="交强险到期时间" :value="data.d_j_outdate")
        van-cell(title="商业险到期时间" :value="data.d_s_outdate")
    imgs(:list="data.imgs")
</template>

<script>
import Imgs from './components/Imgs';
export default {
    components: {
        Imgs
    },
    data() {
        return {
            data: {
                d_price: 0,
                d_s_outdate: 0,
                d_j_outdate: 0,
                options: [],
                imgs: []
            }
        };
    },
    async created() {
        try {
            let { data } = await this.$http.post('/mobile/user/safe', { p: 1 });
            console.log(data);
            data.options.forEach(element => {
                element.val = '';
            });
            this.data = data;
        } catch (error) {
            console.log(error);
        }
    }
};
</script>
