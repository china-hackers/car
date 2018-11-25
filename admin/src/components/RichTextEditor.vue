<template lang="pug">
.comp
    .wrap
        WangEditor(v-model="html")
        .oper
            el-button(type="primary" @click="saveContent") 保存
</template>

<script>
import WangEditor from '@/components/WangEditor';
export default {
    props: {
        visible: false,
        options: {
            type: Object,
            default () {
                return {
                    getUrl: '',
                    postUrl: '',
                    getParams: {},
                    postParams: {}
                };
            }
        }
    },
    watch: {
        visible: {
            handler (v) {
                if (v) {
                    this.getContent();
                }
            },
            immediate: true
        }
    },
    data () {
        return {
            html: ''
        };
    },
    components: {
        WangEditor
    },
    methods: {
        async saveContent () {
            if (this.html === '') {
                this.warning('富文本编辑器内容不能为空');
                return;
            }
            try {
                await this.$http.post(this.options.postUrl, {
                    content: this.html,
                    ...this.options.postParams
                });
                this.success('保存成功');
                this.$emit('edit-success');
            } catch (error) {}
        },
        async getContent () {
            try {
                let response = await this.$http.get(this.options.getUrl, {
                    params: {
                        ...this.options.getParams
                    }
                });
                this.html = response.data.msg;
            } catch (error) {}
        }
    }
};
</script>

<style lang="scss" scoped>
.comp {
    .wrap {
        .oper {
            padding-top: 20px;
            text-align: right;
        }
    }
}
</style>
