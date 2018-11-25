<template lang="pug">
.comp
    .editor-wrap(ref="editor")
</template>

<script>
import WangEditor from 'wangeditor';
let editor = null;
export default {
    props: {
        value: {
            type: String,
            default: ''
        }
    },
    data () {
        return {
            editorContent: ''
        };
    },
    watch: {
        value (v) {
            this.editorContent = v;
            editor.txt.html(this.editorContent);
        }
    },
    mounted () {
        editor = new WangEditor(this.$refs.editor);
        let height = Math.max(300, document.documentElement.clientHeight - 350);
        this.$refs.editor.style.height = `${height}px`;
        editor.customConfig.onchange = html => {
            this.editorContent = html;
            this.$emit('input', this.editorContent);
        };
        editor.customConfig.menus = [
            'head', // 标题
            'bold', // 粗体
            'fontSize', // 字号
            'fontName', // 字体
            'italic', // 斜体
            'underline', // 下划线
            'strikeThrough', // 删除线
            'foreColor', // 文字颜色
            'backColor', // 背景颜色
            'link', // 插入链接
            'list', // 列表
            'justify', // 对齐方式
            'image',
            'quote', // 引用
            'undo', // 撤销
            'redo' // 重复
        ];
        editor.customConfig.uploadImgServer =
            '/index.php?c=Uploader&ajax=1&module=admin';
        editor.customConfig.uploadFileName = 'thefile';

        editor.customConfig.showLinkImg = false;
        editor.customConfig.uploadImgShowBase64 = true;
        editor.customConfig.uploadImgHooks = {
            customInsert: function (insertLinkImg, result, editor) {
                if (result.type === 'succ') {
                    result.msg.forEach(img => {
                        insertLinkImg(img.original.file);
                    });
                } else {
                    this.error('上传失败');
                }
            }
        };
        editor.create();
        editor.txt.html(this.value);
    }
};
</script>
<style lang="scss">
.comp {
    .editor-wrap {
        .w-e-toolbar {
            flex-wrap: wrap;
            background-color: transparent !important;
            padding: 5px !important;
            border-color: #eee !important;
        }
        .w-e-text-container {
            border-color: #eee !important;
            height: calc(100% - 37px) !important;
        }
    }
}
</style>
