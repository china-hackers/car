<template lang="pug">
el-dialog(:title="title" :visible.sync="visible" width="600px")
    .comp-car-type-editor
        el-form(label-width="80px" label-position="left")
            el-form-item(label="品牌")
                | {{letter}}
            el-form-item(label="品牌")
                | {{brand}}
            el-form-item(label="车型名称")
                el-input(v-model="model")
            el-form-item(label="评分")
                el-input-number(v-model="star" :max="5" :min="0" :step="0.01" :precision="2")
            el-form-item(label="关键字")
                el-tag.tag(v-for="(tag, index) in keywords" :key="index" closable @close="handleClose(tag)") {{tag}}
                el-input.tag.input(v-if="inputVisible" class="input-new-tag" v-model="inputValue" ref="saveTagInput" size="small" @keyup.enter.native="handleInputConfirm" @blur="handleInputConfirm")
                el-button.tag.input(v-else class="button-new-tag" size="small" @click="showInput") 新增关键字
            el-form-item(label="")
                my-button(type="primary" :click="save") 保存
</template>

<script>
import dialogMixin from '@/mixins/dialog';
export default {
    mixins: [dialogMixin],
    data () {
        return {
            id: '',
            letter: '',
            brand: '',
            model: '',
            star: 0,
            keywords: [],
            inputValue: '',
            inputVisible: false
        };
    },

    computed: {
        title () {
            if (this.id === '') {
                return '新增车型';
            } else {
                return '修改车型';
            }
        }
    },

    methods: {

        clear () {
            Object.assign(this, {
                id: '',
                letter: '',
                brand: '',
                model: '',
                star: 0,
                keywords: [],
                inputVisible: false
            });
        },

        setLetter (letter) {
            this.letter = letter;
        },

        setBrand (brand) {
            this.brand = brand;
        },

        setEditData (data) {
            data.keywords = data.keywords || [];
            Object.assign(this, data);
        },

        handleClose (tag) {
            this.keywords.splice(this.keywords.indexOf(tag), 1);
        },

        showInput () {
            this.inputVisible = true;
            this.$nextTick(_ => {
                this.$refs.saveTagInput.$refs.input.focus();
            });
        },

        handleInputConfirm () {
            let inputValue = this.inputValue;
            if (inputValue) {
                this.keywords.push(inputValue);
            }
            this.inputVisible = false;
            this.inputValue = '';
        },

        async saveNewType () {
            try {
                await this.$http.post('/admin/car/add', {
                    letter: this.letter,
                    brand: this.brand,
                    model: this.model,
                    star: this.star,
                    keywords: this.keywords
                });
                this.success('保存成功');
                this.close();
                this.$emit('save-success');
            } catch (error) {
                console.log(error);
            }
        },

        async saveEditType () {
            try {
                await this.$http.post('/admin/car/edit', {
                    id: this.id,
                    letter: this.letter,
                    brand: this.brand,
                    model: this.model,
                    star: this.star,
                    keywords: this.keywords.join('|')
                });
                this.success('保存成功');
                this.close();
                this.$emit('save-success');
            } catch (error) {
                console.log(error);
            }
        },

        save () {
            if (this.id === '') {
                return this.saveNewType();
            } else {
                return this.saveEditType();
            }
        }

    }
};
</script>

<style lang="scss" scoped>
.comp-car-type-editor {
    .tag {
        margin-right: 10px;
        &.input {
            width: 150px;
        }
    }
}
</style>
