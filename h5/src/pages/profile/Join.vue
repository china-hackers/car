<template lang="pug">
.page-join
    my-nav-bar(title="加入爱品车")
    van-cell-group
        van-cell.vancell(title="电话" is-link :value="bindPhone" :to="{path:'/my/bind'}")
        my-form-select(label="类型" placeholder="请选择" v-model="type" :actions="[{name:'车商',value:'0'},{name:'I品车销售',value:'1'}]")
        van-field(label="车行名称" v-if="type==='0'" placeholder="请输入车行名称" v-model="business")
        van-field(label="推荐人" v-if="type===1&&hasRecommend" disabled v-model="business")
        van-field(label="真实姓名" placeholder="请输入真实姓名" v-model="form.name")
        my-form-select(label="性别" placeholder="请选择" v-model="form.sex" :actions="[{name:'男',value:'男'},{name:'女',value:'女'}]")
        van-field(label="所在城市" disabled v-model="form.city")
        van-field(label="身份证号" placeholder="请输入身份证号" v-model="form.id_card")
    my-bottom-bar.bottom(:click="save")
        .g-bottom-btn 提交
</template>

<script>
export default {
    data() {
        return {
            hasPhone: false,
            hasRecommend: false,
            business: '',
            phone: '',
            type: '1',
            form: {
                name: '',
                sex: '男',
                city: '成都',
                id_card: ''
            }
        };
    },
    computed: {
        bindPhone() {
            if (this.hasPhone) {
                return this.phone;
            } else {
                return '请先绑定手机';
            }
        }
    },
    methods: {
        async save() {
            if (this.phone === '') {
                this.fail('请先绑定手机');
                return false;
            }
            try {
                let params = { ...this.form };
                if (this.type === '0') {
                    params.business = this.business;
                }
                await this.$http.post('/mobile/business/register', params);
                this.success('申请成功,请耐心等待审核');
                this.$router.replace({
                    path: '/main/profile'
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
    async created() {
        try {
            let { data } = await this.$http.post('/mobile/business/info', {
                p: 1
            });
            if (data.phone) {
                this.phone = data.phone;
                this.hasPhone = true;
            }
            if (data.business) {
                this.business = data.business;
                this.hasRecommend = true;
            }
            console.log(data);
        } catch (error) {
            console.log(error);
        }
    }
};
</script>

<style lang="scss">
.page-join {
    .van-cell__title {
        max-width: 90px;
    }
    .van-cell__value {
        text-align: left;
    }
}
</style>
