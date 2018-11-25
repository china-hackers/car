<template lang="pug">
.page-second-hand-car-editor
    my-page-title(title="新增二手车" btnText="返回" :btnVisible="true" @right-click="back")
    el-tabs(v-model="active")
        el-tab-pane(label="基本信息" name="0")
            my-car-base-info(@start-edit="startEdit")
        el-tab-pane(label="车辆描述" name="1" v-if="type==='edit'")
            my-car-desc
        el-tab-pane(label="基本参数" name="2" v-if="type==='edit'")
            my-car-base-params
        el-tab-pane(label="发动机参数" name="3" v-if="type==='edit'")
            my-car-engine-params
        el-tab-pane(label="底盘参数" name="4" v-if="type==='edit'")
            my-car-chassis-params
        el-tab-pane(label="车轮制动" name="5" v-if="type==='edit'")
            my-car-brake-params
        el-tab-pane(label="手续信息" name="6" v-if="type==='edit'")
            my-car-other-params
        el-tab-pane(label="车辆图片" name="7" v-if="type==='edit'")
            my-images
</template>

<script>
import Desc from './Forms/Desc';
import BaseInfo from './Forms/BaseInfo';
import BaseParams from './Forms/BaseParams';
import EngineParams from './Forms/EngineParams';
import ChassisParams from './Forms/ChassisParams.vue';
import BrakeParams from './Forms/BrakeParams.vue';
import OtherParams from './Forms/OtherParams.vue';
import Images from './Forms/Images';
export default {
    data () {
        return {
            active: '0',
            carId: ''
        };
    },
    components: {
        'my-car-desc': Desc,
        'my-car-base-info': BaseInfo,
        'my-car-base-params': BaseParams,
        'my-car-engine-params': EngineParams,
        'my-car-chassis-params': ChassisParams,
        'my-car-brake-params': BrakeParams,
        'my-car-other-params': OtherParams,
        'my-images': Images
    },
    methods: {
        startEdit () {
        },
        back () {
            history.back();
        }
    },
    computed: {
        type () {
            let path = this.$route.path;
            if (path.indexOf('add') !== -1) {
                return 'add';
            } else {
                return 'edit';
            }
        }
    }
};
</script>
