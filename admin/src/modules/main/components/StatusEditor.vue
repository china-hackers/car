<template lang="pug">
el-dialog(title="状态修改" :visible.sync="visible" width="800px")
    .comp
        el-form(label-width="80px" label-position="left")
            el-form-item(label="")
                el-radio-group(v-model="myValue")
                    el-radio(label="0") 已提交
                    el-radio(label="1") 已接单
                    el-radio(label="2") 资料收集中
                    el-radio(label="3") 审核中
            el-form-item
                my-button(type="primary" :click="save") 保存

</template>

<script>
import dialogMixin from '@/mixins/dialog';
import MyButton from '@/components/MyButton';
export default {
    mixins: [dialogMixin],
    components: {
        'my-button': MyButton
    },
    props: {
        ftype: {
            type: String,
            default: ''
        }
    },
    data () {
        return {
            myValue: '',
            id: ''
        };
    },
    methods: {
        setValue (val) {
            this.myValue = `${val}`;
        },
        setId (id) {
            this.id = id;
        },
        async save () {
            try {
                await this.$http.post(`/admin/finance/${this.ftype}state`, {
                    id: this.id,
                    state: this.myValue
                });
                this.success('变更成功');
                this.close();
                this.$emit('change');
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>
