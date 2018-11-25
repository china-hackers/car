export default {
    data () {
        return {
            visible: false,
            type: 'new'
        };
    },
    computed: {
        titleText () {
            return this.type === 'new' ? '新增' : '编辑';
        }
    },
    methods: {
        open () {
            this.setDefaultValues && this.setDefaultValues();
            this.visible = true;
        },
        clear () {},
        setDefaultValues () {},
        close () {
            this.visible = false;
            this.clear();
        },
        setEditorType (type) {
            this.type = type;
        },
        setId (id) {
            this.form.id = id;
            this.setEditorType('edit');
        }
    }
};
