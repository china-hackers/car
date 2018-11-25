<template>
    <div class="login-container">
        <el-form ref="loginForm"
                 class="login-form"
                 auto-complete="on"
                 label-position="left">
            <h3 class="title">爱品车管理后台</h3>
            <el-form-item prop="username">
                <span class="svg-container svg-container_login">
                </span>
                <el-input v-model="loginForm.username"
                          name="username"
                          type="text"
                          auto-complete="off"
                          placeholder="请输入用户名" />
            </el-form-item>
            <el-form-item prop="password">
                <span class="svg-container">
                </span>
                <el-input type="password"
                          v-model="loginForm.password"
                          name="password"
                          auto-complete="off"
                          placeholder="请输入密码"
                          @keyup.enter.native="handleLogin" />
            </el-form-item>
            <el-form-item>
                <el-button :loading="loading"
                           type="primary"
                           style="width:100%;"
                           @click.native.prevent="handleLogin">
                    开始登录
                </el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
export default {
    name: 'Login',
    data () {
        return {
            loginForm: {
                username: '',
                password: ''
            },
            loading: false
        };
    },
    components: {
    },
    methods: {
        async handleLogin () {
            if (!this.loading) {
                this.loading = true;
                try {
                    await this.$http.post('/admin/site/login', {
                        admin: this.loginForm.username,
                        pswd: this.loginForm.password
                    });
                    window.location.href = '/admin';
                } catch (error) {
                    console.log(error);
                }
                this.loading = false;
            }
        }
    }
};
</script>

<style rel="stylesheet/scss" lang="scss">
$bg: #2d3a4b;
$light_gray: #eee;
/* reset element-ui css */
.login-container {
    .el-input {
        display: inline-block;
        height: 47px;
        width: 85%;
        input {
            background: transparent;
            border: 0px;
            -webkit-appearance: none;
            border-radius: 0px;
            padding: 12px 5px 12px 15px;
            color: $light_gray;
            height: 47px;
            &:-webkit-autofill {
                box-shadow: 0 0 0px 1000px $bg inset !important;
                -webkit-text-fill-color: #fff !important;
            }
        }
    }
    .el-form-item {
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        color: #454545;
    }
}
</style>

<style rel="stylesheet/scss" lang="scss" scoped>
$bg: #2d3a4b;
$dark_gray: #889aa4;
$light_gray: #eee;
.login-container {
    position: fixed;
    height: 100%;
    width: 100%;
    background-color: $bg;
    .login-form {
        position: absolute;
        left: 0;
        right: 0;
        width: 520px;
        padding: 35px 35px 15px 35px;
        margin: 120px auto;
    }
    .tips {
        font-size: 14px;
        color: #fff;
        margin-bottom: 10px;
        span {
            &:first-of-type {
                margin-right: 16px;
            }
        }
    }
    .svg-container {
        padding: 6px 5px 6px 15px;
        color: $dark_gray;
        vertical-align: middle;
        width: 30px;
        display: inline-block;
        &_login {
            font-size: 20px;
        }
    }
    .title {
        font-size: 26px;
        font-weight: 400;
        color: $light_gray;
        margin: 0px auto 40px auto;
        text-align: center;
        font-weight: bold;
    }
    .show-pwd {
        position: absolute;
        right: 10px;
        top: 7px;
        font-size: 16px;
        color: $dark_gray;
        cursor: pointer;
        user-select: none;
    }
}
</style>
