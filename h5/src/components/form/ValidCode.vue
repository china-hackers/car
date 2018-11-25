<template lang="pug">
    van-field(label="验证码" placeholder="请输入验证码" v-model="myValue")
        van-button(slot="button" size="small" type="primary" :disabled="doing" @click="sendCode") {{doing?`${count}s`:'发送验证码'}}
</template>

<script>
export default {
    props: {
        phone: {
            type: String,
            default: ''
        },
        value: {
            type: String,
            default: ''
        }
    },
    watch: {
        value: {
            handler (v) {
                this.myValue = v;
            },
            immediate: true
        },
        myValue () {
            this.$emit('input', this.myValue);
        }
    },
    data () {
        return {
            myValue: '',
            count: 60,
            doing: false
        };
    },
    methods: {
        async sendCode () {
            try {
                if (this.phone === '') {
                    this.fail('电话号码不能为空');
                    return;
                }
                this.doing = true;
                await this.$http.post('/mobile/user/sendcode', {
                    phone: this.phone
                });
                await this.startCount();
            } catch (error) {
                this.doing = false;
                console.log(error);
            }
            this.doing = false;
        },
        startCount () {
            return new Promise(resolve => {
                let timer = setInterval(() => {
                    this.count -= 1;
                    if (this.count === 0) {
                        this.count = 60;
                        clearInterval(timer);
                        resolve(true);
                        this.doing = false;
                    }
                }, 1000);
            });
        }
    }

};
</script>
