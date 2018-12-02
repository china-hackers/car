<template lang="pug">
.page-car-param
    my-nav-bar(title="车辆参数")
    my-key-value(:list="list")
</template>

<script>
export default {
    data() {
        return {
            id: '',
            list: []
        };
    },
    methods: {
        async getTax() {
            try {
                let { data } = await this.$http.post('/mobile/product/tax', {
                    id: this.id
                });
                this.list = this.list.concat([
                    {
                        key: '首付',
                        val: data.shoufu
                    },
                    {
                        key: '月供',
                        val: data.yuegong
                    },
                    {
                        key: '年检到期',
                        val: data.nian_date
                    },
                    {
                        key: '交强险到期',
                        val: data.jiao_date
                    },
                    {
                        key: '商业险到期',
                        val: data.shang_date
                    },
                    {
                        key: '新车质保',
                        val: data.zhi_date
                    }
                ]);
                // console.log(data);
            } catch (error) {
                console.log(error);
            }
        },
        async getUnder() {
            try {
                let { data } = await this.$http.post('/mobile/product/under', {
                    id: this.id
                });
                this.list = this.list.concat([
                    {
                        key: '驱动方式',
                        val: data.dirve_type
                    },
                    {
                        key: '转向系统',
                        val: data.turn_sys
                    },
                    {
                        key: '前悬挂',
                        val: data.head_sys
                    },
                    {
                        key: '后悬挂',
                        val: data.back_sys
                    }
                ]);
            } catch (error) {
                console.log(error);
            }
        },
        async getEngine() {
            try {
                let { data } = await this.$http.post('/mobile/product/engine', {
                    id: this.id
                });
                this.list = this.list.concat([
                    {
                        key: '百公里油耗(L)',
                        val: data.oil_wear
                    },
                    {
                        key: '燃油',
                        val: data.oil
                    },
                    {
                        key: '排量(L)',
                        val: data.displacement
                    },
                    {
                        key: '燃油标号',
                        val: data.oil_no
                    },
                    {
                        key: '油箱容积(L)',
                        val: data.oil_capacity
                    },
                    {
                        key: '功率(KW)',
                        val: data.power
                    },
                    {
                        key: '进气形式',
                        val: data.air_in
                    },
                    {
                        key: '最高车速(km/h)',
                        val: data.speed
                    },
                    {
                        key: '最大扭矩(N.m)',
                        val: data.nm
                    },
                    {
                        key: '官方0-100加速(s)',
                        val: data.speed_up
                    }
                ]);
                console.log(data);
            } catch (error) {
                console.log(error);
            }
        },
        async getTyre() {
            try {
                let { data } = await this.$http.post('/mobile/product/tyre', {
                    id: this.id
                });
                this.list = this.list.concat([
                    {
                        key: '前轮制动',
                        val: data.head_drive
                    },
                    {
                        key: '后轮制动',
                        val: data.back_drive
                    },
                    {
                        key: '前轮规格',
                        val: data.head_std
                    },
                    {
                        key: '后轮规格',
                        val: data.back_std
                    }
                ]);
            } catch (error) {
                console.log(error);
            }
        }
    },
    created() {
        this.id = this.$route.query.id;
        this.getTax();
        this.getUnder();
        this.getEngine();
        this.getTyre();
    }
};
</script>

<style lang="scss" scoped>
</style>
