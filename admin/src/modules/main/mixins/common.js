import StatusEditor from '../components/StatusEditor';
import FinanceDealer from '../components/FinanceDealer';
import InsuranceDealer from '../components/InsuranceDealer';
export default {
    data() {
        return {
            orderStatus: {
                '0': '已提交',
                '1': '已接单',
                '2': '资料收集中',
                '3': '审核中',
                '4': '成交'
            }
        };
    },
    components: {
        StatusEditor,
        FinanceDealer,
        InsuranceDealer
    },
    methods: {
        getStatusText(code) {
            return this.orderStatus[`${code}`];
        },
        changeStatus(scope) {
            let comp = this.$refs['status-editor'];
            comp.setValue(scope.row.state);
            comp.setId(scope.row.id);
            comp.open();
        },
        // 成交
        async deal(item) {
            try {
                let comp = this.$refs['dealer-editor'];
                comp.setId(item.id);
                comp.open();
            } catch (error) {
                console.log(error);
            }
        }
    }
};
