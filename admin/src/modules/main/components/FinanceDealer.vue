<template lang="pug">
el-dialog(title="贷款成交" :visible.sync="visible" width="800px")
    el-form.form(label-width="150px" label-position="left")
        el-form-item(label="成交借款人姓名")
            el-input(v-model="form.d_name")
        el-form-item(label="成交借款人电话")
            el-input(type="tel" v-model="form.d_phone")
        el-form-item(label="成交贷款类型")
            el-select(v-model="form.d_type")
                el-option(label="新车贷款" value="新车贷款")
                el-option(label="二手车贷款" value="二手车贷款")
                el-option(label="有车贷款" value="有车贷款")
        //- 加利息
        el-form-item(label="实际还款总额(元)")
            el-input-number(:min="0" :precision="0" v-model="form.d_money_return")
        //- 不加利息
        el-form-item(label="贷款总额(元)")
            el-input-number(:min="0" :precision="0" v-model="form.d_money")
        el-form-item(label="最终贷款时间(月数)")
            el-input-number(:min="0" :precision="0" v-model="form.d_month")
        el-form-item(label="每月还款金额(元)")
            el-input-number(:min="0" :precision="0" v-model="form.d_pay")
        el-form-item(label="首次还款时间")
            el-date-picker(type="date" v-model="form.d_date" value-format="yyyy-MM-dd")
        my-form-images(label="用户资料" :size="100" action="/admin/site/loanimg" v-model="form.imgs")
        el-form-item
            my-button(type="primary" :click="save") 保存
</template>

<script>
import dialogMixin from '@/mixins/dialog';
export default {
    mixins: [dialogMixin],
    data () {
        return {
            form: {
                id: '',
                d_name: '',
                d_phone: '',
                d_type: '',
                d_money: 0,
                d_money_return: 0,
                d_month: 0,
                d_pay: 0,
                d_date: '',
                imgs: []
            }
        };
    },
    methods: {
        setId (id) {
            this.form.id = id;
            this.getInfo();
        },
        async getInfo () {
            try {
                let {data} = await this.$http.post('/admin/finance/loan', {
                    id: this.form.id
                });
                console.log(data);
                Object.assign(this.form, {
                    'd_name': data.data['d_name'],
                    'd_phone': data.data['d_phone'],
                    'd_type': data.data['d_type'],
                    'd_money': data.data['d_money'],
                    'd_money_return': data.data['d_money_return'],
                    'd_month': data.data['d_month'],
                    'd_pay': data.data['d_pay'],
                    'd_price': data.data['d_price'],
                    'd_date': data.data['d_date'],
                    'imgs': data.data['imgs']
                });
            } catch (error) {
                console.log(error);
            }
        },
        setDefaultData (data) {
            Object.assign(this.form, {
                'd_name': data.name,
                'd_phone': data.phone,
                'd_type': data.itype,
                'd_money': data.money,
                'd_month': data.years * 12
            });
        },
        async save () {
            try {
                await this.$http.post('/admin/finance/loancheck', this.form);
                this.success('保存成功');
                this.$emit('success');
                this.close();
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>
