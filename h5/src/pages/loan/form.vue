<template lang="pug">
.page-loan-form
    my-nav-bar(title="I品金融")
    van-cell-group
        van-field(label="姓名" placeholder="请输入姓名" v-model="form.name")
        van-field(label="电话" placeholder="请输入电话" v-model="form.phone")
        my-form-select(label="贷款类型" placeholder="请选择" v-model="form.itype" :actions="typeActions")
        van-field(label="贷款金额(元)" placeholder="最高可贷50W" v-model="form.money")
        my-form-select(label="贷款时间" placeholder="贷款时间" v-model="form.years" :actions="yearsActions")
    my-bottom-bar.bottom(:click="save")
        .btn 提交
</template>

<script>
export default {
    data () {
        return {
            typeActions: [
                {
                    name: '新车贷款',
                    value: '新车贷款'
                }, {
                    name: '二手车贷款',
                    value: '二手车贷款'
                }, {
                    name: '有车贷款',
                    value: '有车贷款'
                }
            ],
            yearsActions: [
                {
                    name: '1年',
                    value: '1'
                }, {
                    name: '2年',
                    value: '2'
                }, {
                    name: '3年',
                    value: '3'
                }, {
                    name: '4年',
                    value: '4'
                }, {
                    name: '5年',
                    value: '5'
                }
            ],
            form: {
                name: '',
                phone: '',
                itype: '',
                money: '',
                years: ''
            }
        };
    },
    methods: {
        async save () {
            try {
                await this.$http.post('/mobile/finance/loanadd', this.form);
                this.success('保存成功');
                history.back();
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>

<style lang="scss">
.page-loan-form {
    .btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
    }
}
</style>
