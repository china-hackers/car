<template lang="pug">
.page
    my-nav-bar(title="我的销售")
    van-cell-group
        van-cell(v-for="item in list" :key="item.id" :title="item.name" :value="item.phone")
</template>

<script>
export default {
    data () {
        return {
            list: []
        };
    },
    async created () {
        try {
            let {data} = await this.$http.post('/mobile/business/salerlist', {p: 1});
            this.list = data;
        } catch (error) {
            console.log(error);
        }
    }
};
</script>
