<template lang="pug">
.page
    my-page-title(title="首页推荐位")
    el-form(label-width="120px" label-position="left")

        my-form-images(label="大图(375*96)" action="/admin/site/recommandimg" v-model="img")

        el-form-item(label="推荐位1标题")
            el-input(v-model="car[0].title")
        el-form-item(label="推荐位1车型")
            el-input(v-model="car[0].model")
        el-form-item(label="推荐位1标签")
            el-input(v-model="car[0].keyword")
        el-form-item(label="推荐位1链接")
            el-input(v-model="car[0].url")
        my-form-images(label="推荐位1封面(75*75)" action="/admin/site/recommandimg" v-model="car[0].img")

        el-form-item(label="推荐位2标题")
            el-input(v-model="car[1].title")
        el-form-item(label="推荐位2车型")
            el-input(v-model="car[1].model")
        el-form-item(label="推荐位2标签")
            el-input(v-model="car[1].keyword")
        el-form-item(label="推荐位2链接")
            el-input(v-model="car[1].url")
        my-form-images(label="推荐位2封面(75*75)" action="/admin/site/recommandimg" v-model="car[1].img")

        el-form-item(label="推荐位3标题")
            el-input(v-model="car[2].title")
        el-form-item(label="推荐位3车型")
            el-input(v-model="car[2].model")
        el-form-item(label="推荐位3标签")
            el-input(v-model="car[2].keyword")
        el-form-item(label="推荐位3链接")
            el-input(v-model="car[2].url")
        my-form-images(label="推荐位3封面(75*75)" action="/admin/site/recommandimg" v-model="car[2].img")

        el-form-item(label="")
            my-button(type="primary" :click="save") 保存
</template>

<script>
export default {
    data() {
        return {
            img: '',
            car: [
                {
                    title: '',
                    model: '',
                    keyword: '',
                    url: '',
                    img: ''
                },
                {
                    title: '',
                    model: '',
                    keyword: '',
                    url: '',
                    img: ''
                },
                {
                    title: '',
                    model: '',
                    keyword: '',
                    url: '',
                    img: ''
                }
            ]
        };
    },
    methods: {
        async save() {
            try {
                await this.$http.post('/admin/banner/recommandsave', {
                    img: this.img,
                    car: this.car
                });
                this.success('保存成功');
            } catch (error) {
                console.log(error);
            }
        },
        async getInfo() {}
    },
    async created() {
        try {
            let { data } = await this.$http.post('/mobile/banner/recommand', {
                p: 1
            });
            Object.assign(this, data.data);
        } catch (error) {
            console.log(error);
        }
    }
};
</script>
