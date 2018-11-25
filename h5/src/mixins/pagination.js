export default {
    data () {
        return {
            pagination: {
                curPage: 1,
                pageSize: 20,
                pageTotal: 1
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
        }
    }
};
