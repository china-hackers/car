import {
    mapState
} from 'vuex';

function transparent (array) {
    return array.map(item => {
        return {
            name: item,
            value: item
        };
    });
}

export default {
    computed: mapState({
        gas: state => transparent(state.carConfig.gas),
        model: state => transparent(state.carConfig.model),
        color: state => transparent(state.carConfig.color),
        gearBox: state => transparent(state.carConfig.gearBox),
        hubMaterial: state => transparent(state.carConfig.hubMaterial),
        inlet: state => transparent(state.carConfig.inlet),
        fuel: state => transparent(state.carConfig.fuel),
        fuelLabel: state => transparent(state.carConfig.fuelLabel),
        drivingModel: state => transparent(state.carConfig.drivingModel),
        steeringSystem: state => transparent(state.carConfig.steeringSystem),
        suspensionSystem: state => transparent(state.carConfig.suspensionSystem),
        brake: state => transparent(state.carConfig.brake)
    })
};
