<template lang="pug">
el-dialog(title="审核车商" :visible.sync="visible" width="800px")
    .comp-car-dealer-verify
        h3 机构信息
        .infos
            .item
                .label 车商名称
                .value {{dealerInfo.name}}
            .item
                .label 电话号码
                .value {{dealerInfo.phone}}
            .item
                .label 备注
                .value {{dealerInfo.note}}
            .item
                .label 地址
                .value {{dealerInfo.address}}
            .item
                .label 经纬度
                .value {{dealerInfo.lat}},{{dealerInfo.lng}}
            .item
                .label LOGO
                .value
                    my-avatar(:src="dealerInfo.logo||''")
        h3 申请者信息
        .infos
            .item
                .label 用户名
                .value {{userInfo.name}}
            .item
                .label 头像
                .value
                    my-avatar(:src="userInfo.avatar||''")
            .item
                .label 昵称
                .value {{userInfo.nick}}
            .item
                .label 性别
                .value {{userInfo.sex}}
            .item
                .label 电话
                .value {{userInfo.phone}}
            .item
                .label 是否审核
                .value {{userInfo.is_checked===1?'是':'否'}}

        .btns
            my-button.btn(:click="pass") 通过审核
            my-button(type="plain" :click="reject") 不通过审核
</template>

<script>
import dialogMixin from '@/mixins/dialog';
export default {
    mixins: [dialogMixin],
    data () {
        return {
            dealerInfo: {},
            userInfo: {}
        };
    },
    methods: {
        setDealerInfo (data) {
            this.dealerInfo = data;
            this.getUserInfo();
        },
        async getUserInfo () {
            try {
                let { data } = await this.$http.post('/admin/business/user', {
                    bid: this.dealerInfo.id
                });
                this.userInfo = data.data;
                console.log(data);
            } catch (error) {
                console.log(error);
            }
        },
        async pass () {
            try {
                await this.$confirm('确认审核通过吗？');
                await this.$http.post('/admin/business/check', {
                    bid: this.dealerInfo.id,
                    check: 1
                });
                this.close();
                this.$emit('change');
            } catch (error) {
                console.log(error);
            }
        },
        async reject (item) {
            try {
                await this.$confirm('确认审核删除吗？');
                await this.$http.post('/admin/business/check', {
                    bid: this.dealerInfo.id,
                    check: 0
                });
                this.close();
                this.$emit('change');
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-car-dealer-verify {
    h3 {
        font-size: 16px;
        font-weight: bold;
        padding: 20px 0;
        &:first-child {
            padding-top: 0;
        }
    }
    .infos {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        .item {
            width: 40%;
            display: flex;
            align-items: center;
            padding: 5px 0;
            .label {
                width: 100px;
                flex-shrink: 0;
                height: 40px;
                line-height: 40px;
            }
        }
    }
    .btns {
        padding-top: 20px;
        .btn {
            margin-right: 10px;
        }
    }
}
</style>
