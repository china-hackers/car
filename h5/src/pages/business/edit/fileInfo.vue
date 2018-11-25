<template lang="pug">
.page
    my-nav-bar(title="手续信息")
    van-cell-group
        van-field(label="首付(万)" placeholder="请输入" type="numner" v-model="form.shoufu")
        van-field(label="月供(万)" placeholder="请输入" type="numner" v-model="form.yuegong")
        van-field(label="年检到期" type="date" placeholder="请输入" v-model="form.nian_date")
        van-field(label="交强险到期" type="date" placeholder="请输入" v-model="form.jiao_date")
        van-field(label="商业险到期" type="date" placeholder="请输入" v-model="form.shang_date")
        van-field(label="质保到期" type="date" placeholder="请输入" v-model="form.zhi_date")
    my-bottom-bar.bottom(:click="save")
        .g-bottom-btn 提交
</template>

<script>
import carEditMixin from '../mixins/carEdit';
export default {
    mixins: [carEditMixin],
    data () {
        return {
            form: {
                nian_date: '',
                jiao_date: '',
                shang_date: '',
                zhi_date: '',
                shoufu: '',
                yuegong: ''
            }
        };
    },
    methods: {
        async save () {
            try {
                await this.$http.post('/mobile/product/taxsave', {
                    id: this.$route.query.id,
                    ...this.form
                });
                this.success('保存成功');
                history.back();
            } catch (error) {
                console.log(error);
            }
        }
    },
    async created () {
        try {
            let { data } = await this.$http.post('/mobile/product/tax', {
                id: this.$route.query.id
            });
            this.form = {
                nian_date: data['nian_date'],
                jiao_date: data['jiao_date'],
                shang_date: data['shang_date'],
                zhi_date: data['zhi_date'],
                shoufu: data['shoufu'],
                yuegong: data['yuegong']
            };
        } catch (error) {
            console.log(error);
        }
    }
};
</script>
