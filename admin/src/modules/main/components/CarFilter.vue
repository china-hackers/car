<template lang="pug">
.comp-car-filter
    .item
        label 首字母
        .right
            .choose-item(:class="{choosed:choosedLetter==''}" @click="chooseLetter('')") 不限
            .choose-item(v-for="letter in letterList" :class="{choosed:letter==choosedLetter}" @click="chooseLetter(letter)") {{letter}}
    .item
        label 品牌
        .right
            .choose-item(:class="{choosed:choosedBrand==''}" @click="chooseBrand('')") 不限
            .choose-item(v-for="brand in brandList" :class="{choosed:brand.brand==choosedBrand}" @click="chooseBrand(brand.brand)") {{brand.brand}}
    .item
        label 车型
        .right
            .choose-item(:class="{choosed:choosedTypeId==''}" @click="chooseType('')") 不限
            .choose-item(v-for="type in typeList" :class="{choosed:type.id==choosedTypeId}" @click="chooseType(type.id)") {{type.model}}
    .item
        label 价格
        .right
            .my-define
                el-input-number(v-model="price_from" size="small" :min="0" controls-position="right" :precision="2" :step="0.01"  placeholder="万元")
                .space -
                el-input-number(v-model="price_to" size="small" :min="0" controls-position="right" :precision="2" :step="0.01"  placeholder="万元")
    .item
        label 车行名称
        .right
            .my-define
                el-input.text(v-model="business_name" size="small")
    .item
        label
        .right
            el-button(type="primary" @click="startSearch") 开始搜索
</template>

<script>
export default {
    data() {
        return {
            choosedLetter: '',
            letterList: [],
            choosedBrand: '',
            brandList: [],
            typeList: [],
            choosedTypeId: '',
            business_name: '',
            price_from: 0,
            price_to: 0
        };
    },
    methods: {
        async getLetterList() {
            try {
                let { data } = await this.$http.post('/admin/car/letterlist', {
                    p: 1
                });
                this.letterList = data.data.list;
                await this.chooseLetter('');
            } catch (error) {
                console.log(error);
            }
        },
        async chooseLetter(letter) {
            this.choosedLetter = letter;
            this.choosedTypeId = '';
            await this.getBrandList();
        },
        async getBrandList() {
            try {
                let { data } = await this.$http.post('/admin/car/brandlist', {
                    letter: this.choosedLetter,
                    p: 1
                });
                this.brandList = data.data.list;
                await this.chooseBrand('');
            } catch (error) {
                console.log(error);
            }
        },
        async chooseBrand(brand) {
            this.choosedBrand = brand;
            if (brand !== '') {
                await this.getTypeList();
            }
            this.choosedTypeId = '';
        },
        async getTypeList() {
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
        chooseType(typeId) {
            this.choosedTypeId = typeId;
        },
        newCar() {
            this.$emit('new-car');
        },
        startSearch() {
            this.$emit('start-search', {
                letter: this.choosedLetter,
                brand: this.choosedBrand,
                car_id: this.choosedTypeId, // 车型ID
                price_from: this.price_from, // 高价格
                price_to: this.price_to, // 低价格
                business_name: this.business_name
            });
        }
    },
    async created() {
        await this.getLetterList();
        this.startSearch();
    }
};
</script>

<style lang="scss" scoped>
.comp-car-filter {
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
            .my-define {
                display: flex;
                align-items: center;
                // margin-left: 10px;
                .el-input {
                    width: 60px;
                    &.text {
                        width: 300px;
                    }
                }
                .space {
                    padding: 0 10px;
                }
                .el-button {
                    margin-left: 10px;
                }
            }
            .el-dropdown {
                margin: 5px 10px 5px 0;
            }
        }
        .all {
            flex-shrink: 0;
            align-self: flex-end;
            margin: 0 10px;
            .el-button {
                color: #666;
                padding: 17px 0;
            }
        }
    }
}
</style>
