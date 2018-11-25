export default {
    data () {
        return {
            pagination: {
                curPage: 1,
                pageSize: 20,
                pageTotal: 0
            }
        };
    },
    methods: {
        pageSizeChange (size) {
            this.pagination.pageSize = size;
            this.req();
        },
        pageCurPageChange (cur) {
            this.pagination.curPage = cur;
            this.req();
        },
        req () {},
        dealData (data) {
            this.list = data.list;
            this.pagination.pageTotal = data.total;
        },
        async research () {
            this.pagination.curPage = 1;
            await this.req();
        }
    }
};
