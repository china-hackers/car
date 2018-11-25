<template lang="pug">
.page-car-types
    my-page-title(title="车型管理" :btnVisible="false")
    .car-filter
        .item
            label 首字母
            .right
                .choose-item(v-for="letter in letterList" :class="{choosed:letter==choosedLetter}" @click="chooseLetter(letter)") {{letter}}
        .item
            label 品牌
            .right
                .choose-item(v-for="brand in brandList" :class="{choosed:brand.brand==choosedBrand}" @click="chooseBrand(brand.brand)") {{brand.brand}}

    el-button.mb-20(type="primary" @click="addType") 新增车型

    .types
        el-table(:data="typeList" border style="width: 100%")
            el-table-column(align="center" type="index")
            el-table-column(align="center" label="车型名称" prop="model")
            el-table-column(align="center" label="关键字" prop="keywords")
                template(slot-scope="scope")
                    el-tag(v-for="(tag, index) in scope.row.keywords" :key="index") {{tag}}
            el-table-column(align="center" label="评分" prop="star")
            el-table-column(align="center" label="操作" prop="")
                template(slot-scope="scope")
                    el-button(type="text" @click="editType(scope.row)") 修改
                    el-button(type="text" @click="delType(scope.row)") 删除

    my-car-type-editor(ref="my-car-type-editor" @save-success="getTypeList")

</template>

<script>
import CarFilter from '../../components/CarFilter';
import CarTypeEditor from './components/CarTypeEditor';
export default {
    components: {
        'my-car-filter': CarFilter,
        'my-car-type-editor': CarTypeEditor
    },
    data () {
        return {
            choosedLetter: '',
            letterList: [],
            choosedBrand: '',
            brandList: [],
            typeList: []
        };
    },
    methods: {
        async getLetterList () {
            try {
                let { data } = await this.$http.post('/admin/car/letterlist', {p: 1});
                this.letterList = data.data.list;
                this.chooseLetter('A');
            } catch (error) {
                console.log(error);
            }
        },
        chooseLetter (letter) {
            this.choosedLetter = letter;
            this.getBrandList();
        },
        async getBrandList () {
            try {
                let { data } = await this.$http.post('/admin/car/brandlist', {
                    letter: this.choosedLetter,
                    p: 1
                });
                this.brandList = data.data.list;
                this.chooseBrand(data.data.list[0].brand);
            } catch (error) {
                console.log(error);
            }
        },
        chooseBrand (brand) {
            this.choosedBrand = brand;
            this.getTypeList();
        },
        async getTypeList () {
            try {
                let { data } = await this.$http.post('/admin/car/modellist', {
                    brand: this.choosedBrand
                });
                this.typeList = data.data.list;
                console.log(data);
            } catch (error) {
                console.log(error);
            }
        },
        async addType () {
            try {
                let comp = this.$refs['my-car-type-editor'];
                comp.setLetter(this.choosedLetter);
                comp.setBrand(this.choosedBrand);
                comp.open();
            } catch (error) {
                console.log(error);
            }
        },
        async editType (type) {
            try {
                let comp = this.$refs['my-car-type-editor'];
                comp.setEditData(this._.cloneDeep(type));
                comp.open();
            } catch (error) {
                console.log(error);
            }
        },
        async delType (type) {
            try {
                await this.$confirm('确认删除该车型吗？');
                await this.$http.post('/admin/car/delete', {
                    id: type.id
                });
                this.success('删除成功');
                this.getTypeList();
            } catch (error) {
                console.log(error);
            }
        }
    },
    created () {
        this.getLetterList();
    }
};
</script>

<style lang="scss" scoped>
.page-car-types {
    .car-filter {
        border: 1px solid #ebeef5;
        margin-bottom: 20px;
        .item {
            display: flex;
            align-items: stretch;
            min-height: 50px;
            border-bottom: 1px solid #ebeef5;
            &:last-child {
                border-bottom: 0 none;
            }
            label {
                flex-shrink: 0;
                width: 70px;
                text-align: center;
                background-color: #f5f5f5;
                line-height: 50px;
                color: #666;
            }
            .right {
                flex-grow: 1;
                display: flex;
                align-items: center;
                flex-wrap: wrap;
                padding: 10px;
                .choose-item {
                    margin: 5px 5px 5px 0;
                    padding: 5px 7px;
                    cursor: pointer;
                    &.choosed {
                        margin-right: 10px;
                        background-color: #0cb25e;
                        color: #fff;
                    }
                }
            }
        }
    }
    .types {
        .el-tag {
            margin: 5px;
        }
    }
}
</style>
