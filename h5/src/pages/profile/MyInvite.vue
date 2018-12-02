<template lang="pug">
.page-qr
    my-nav-bar(title="我的邀请")
    van-cell-group
        van-cell(v-for="item in list" :key="item.id" :title="item.nickname" :value="item.phone")
</template>

<script>
export default {
    data() {
        return {
            list: []
        };
    },
    async created() {
        try {
            let { data } = await this.$http.post('/mobile/user/invite', {
                p: 1
            });
            this.list = data;
        } catch (error) {
            console.log(error);
        }
    }
};
</script>
