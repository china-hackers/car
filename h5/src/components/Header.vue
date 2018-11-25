<template lang="pug">
.comp-header
    .wrap.flex
        .location.flex
            //- van-icon(name="location")
            | 成都
        van-field.search(clearable v-model="text" type="search" left-icon="search" placeholder="搜索您要搜索的车" @search="handleSearch")
        .call.flex
            van-icon(name="phone")
</template>

<script>
export default {
    props: {
        value: {
            type: String,
            default: ''
        }
    },
    watch: {
        value: {
            handler (v) {
                this.text = v;
            },
            immediate: true
        }
    },
    data () {
        return {
            text: ''
        };
    },
    methods: {
        handleSearch () {
            console.log('search');
            if (window.location.hash.indexOf('main/home') !== -1) {
                this.$router.push({
                    path: '/main/car',
                    query: {
                        title: this.text
                    }
                });
            } else {
                // this.$emit('search');
                this.$emit('input', this.text);
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-header {
    width: 100%;
    height: 2.67rem;
    .wrap {
        position: fixed;
        width: 100%;
        height: 2.67rem;
        background-color: #fff;
        z-index: 100;
        .location {
            width: 6rem;
            justify-content: center;
            height: 100%;
        }
        .call {
            width: 4rem;
            height: 100%;
            font-size: 16px;
            justify-content: center;
        }
        .search {
            background-color: rgb(229, 229, 229);
            padding: 2px 15px;
            border-radius: 15px;
        }
    }
}
</style>
