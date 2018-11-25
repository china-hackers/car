<template lang="pug">
.comp(@click="jump")
    .icon
        i.iconfont(v-html="icon")
    .text {{text}}
</template>

<script>
export default {
    props: {
        icon: {
            type: String,
            default: ''
        },
        text: {
            type: String,
            default: ''
        },
        path: {
            type: String,
            default: ''
        }
    },
    methods: {
        jump () {
            this.$router.push({
                path: this.path
            });
        }
    }
};
</script>

<style lang="scss" scoped>
.comp {
    border-right: 1px solid #eee;
    border-bottom: 1px solid #eee;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #f04c03;
    .icon {
        height: 2.4rem;
        i {
            font-size: 2rem;
        }
    }
    .text {
        font-size: 1.1rem;
    }
}
</style>
