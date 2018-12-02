<template lang="pug">
.comp-mybutton
    el-button(:size="size" :type="type" :loading="loading" :disabled="loading" @click="handleClick")
        slot
</template>

<script>
export default {
    props: {
        size: '',
        type: {
            type: String,
            default: 'primary'
        },
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
                this.loading = true;
                try {
                    await this.click();
                } catch (error) {
                    console.log(error);
                }
                this.loading = false;
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.comp-mybutton {
    display: inline-block;
}
</style>
