export default {
    methods: {
        sortHandler (sort) {
            if (sort.prop !== null) {
                this.order = this.sortEnum[sort.prop];
                this.order_type = sort.order === 'ascending' ? 1 : 0;
            } else {
                this.order = 0;
                this.order_type = 0;
            }
            this.req();
        }
    }
};
