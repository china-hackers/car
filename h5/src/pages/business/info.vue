<template lang="pug">
.page
    my-nav-bar(title="车商信息")
    van-cell-group
        van-cell(title="车行名称" :value="form.name")
        van-cell(title="电话" :value="form.phone")
        van-cell(title="地址" :value="form.address")
        van-cell(title="所在城市" :value="form.ucity")
        van-cell(title="管理员电话" :value="form.uphone")
        van-cell(title="性别" :value="form.usex")
        van-cell(title="真实姓名" :value="form.uname")
        van-cell(title="身份证号" :value="form.ucard")
</template>

<script>
export default {
    data () {
        return {
            form: {
                name: '',
                phone: '',
                address: ''
            }
        };
    },
    async created () {
        try {
            let {data} = await this.$http.post('/mobile/business/business', {p: 1});
            console.log(data);
            this.form = {
                name: data.name,
                phone: data.phone,
                address: data.address,
                uname: data.uname,
                uphone: data.uphone,
                ucity: data.ucity,
                ucard: data.ucard,
                usex: data.usex
            };
        } catch (error) {
            console.log(error);
        }
    }
};
</script>
