<template lang="pug">
.comp-bottom-bar
    .wrap.flex(@click="handleClick")
        slot
</template>

<script>
export default {
    props: {
        click: {
            type: Function,
            default: () => {}
        }
    },
    data() {
        return {
            loading: false
        };
    },
    methods: {
        async handleClick() {
            if (!this.loading) {
                try {
                    this.loading = true;
                    await this.click();
                } catch (error) {
                    console.log(error);
                }
            }
            this.loading = false;
        }
    }
};
</script>

<style lang="scss">
.comp-bottom-bar {
    height: 50px;
    .wrap {
        background-color: #e86352;
        width: 100%;
        height: 50px;
        position: fixed;
        bottom: 0;
        left: 0;
        align-items: stretch;
        box-shadow: 0 0 5px #aaa;
    }
}
</style>
