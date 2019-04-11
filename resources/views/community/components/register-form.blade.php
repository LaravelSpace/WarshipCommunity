<template id="template-register-form">
    <div class="px-3 py-3 border border-primary rounded">
        <div class="form-group text-center">
            <h3>用户注册</h3>
        </div>
        <hr class="my-4">
        <div class="form-group">
            <label for="register-email">登录身份：</label>
            <div class="input-group mb-3">
                <input type="text" id="register-email" class="form-control" :class="emailValid"
                       placeholder="Email" v-model="emailRegister">
                <div class="input-group-append">
                    <a tabindex="0" class="btn btn-outline-secondary" data-container="body"
                       data-toggle="popover" data-trigger="focus" data-placement="right"
                       data-content="第一次注册请使用邮箱作为登录身份">
                        <i class="fa fa-question-circle-o"></i>
                    </a>
                </div>
                <div class="valid-feedback">@{{ emailValidMsg }}</div>
                <div class="invalid-feedback">@{{ emailValidMsg }}</div>
            </div>
        </div>
        <div class="form-group">
            <label for="register-password">登录密码：</label>
            <div class="input-group mb-3">
                <input type="password" id="register-password" class="form-control" :class="passwordValid"
                       placeholder="Password" v-model="passwordRegister">
                <div class="input-group-append">
                    <a tabindex="0" class="btn btn-outline-secondary" data-container="body"
                       data-toggle="popover" data-trigger="focus" data-placement="right"
                       data-content="密码最少6位，包含至少1个大写字母，1个小写字母，1个数字，1个特殊字符">
                        <i class="fa fa-question-circle-o"></i>
                    </a>
                </div>
                <div class="valid-feedback">@{{ passwordValidMsg }}</div>
                <div class="invalid-feedback">@{{ passwordValidMsg }}</div>
            </div>
        </div>
        <div class="form-group">
            <label for="confirm-password">确认密码：</label>
            <div class="input-group mb-3">
                <input type="password" id="confirm-password" class="form-control" :class="confirmValid"
                       placeholder="Confirm Password" v-model="confirmPassword">
                <div class="input-group-append">
                    <a tabindex="0" class="btn btn-outline-secondary" data-container="body"
                       data-toggle="popover" data-trigger="focus" data-placement="right"
                       data-content="再次输入密码">
                        <i class="fa fa-question-circle-o"></i>
                    </a>
                </div>
                <div class="valid-feedback">@{{ confirmValidMsg }}</div>
                <div class="invalid-feedback">@{{ confirmValidMsg }}</div>
            </div>
        </div>
        <hr class="my-4">
        <div class="form-group text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-lg btn-primary px-5"
                        v-if="registerValid" @click="registerPost()">确认注册
                </button>
                <button type="button" class="btn btn-lg btn-primary px-5"
                        v-else disabled>确认注册
                </button>
                <button type="button" class="btn btn-lg btn-warning px-5"
                        @click="registerReset()">重置表单
                </button>
            </div>
        </div>
    </div>
</template>
<script>
    Vue.component('vue-register-form', {
        template: '#template-register-form',
        data: function () {
            return {
                emailRegister: '',
                emailValidMsg: '',
                emailValidTag: false,
                passwordRegister: '',
                passwordValidMsg: '',
                passwordValidTag: false,
                confirmPassword: '',
                confirmValidMsg: '',
                confirmValidTag: false
            }
        },
        created: function () {
            this.init();
        },
        methods: {
            init: function () {
                // 初始化 BootStrap 弹出框
                $(document).ready(function () {
                    $('[data-toggle="popover"]').popover()
                })
            },
            registerPost: function () {
                let thisVue = this;
                axios.post(
                    '/community/user/register/sign-up', {
                        'username': thisVue.emailRegister,
                        'password': thisVue.passwordRegister,
                        'password_confirmation': thisVue.confirmPassword
                    }
                ).then(function (response) {
                    console.log(response.data);
                }).catch(function (error) {
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                });
            },
            registerReset: function () {
                this.emailRegister = '';
                this.emailValidMsg = '';
                this.emailValidTag = false;
                this.passwordRegister = '';
                this.passwordValidMsg = '';
                this.passwordValidTag = false;
                this.confirmPassword = '';
                this.confirmValidMsg = '';
                this.confirmValidTag = false;
            }
        },
        computed: {
            emailValid: function () {
                if (this.emailRegister === null || this.emailRegister === '') {
                    this.emailValidTag = false;
                }
                if (this.emailRegister !== null && this.emailRegister !== '') {
                    if (regEmail.test(this.emailRegister)) {
                        this.emailValidMsg = '';
                        this.emailValidTag = true;
                        return 'is-valid';
                    } else {
                        this.emailValidMsg = '不正确的邮箱地址';
                        this.emailValidTag = false;
                        return 'is-invalid';
                    }
                }
            },
            passwordValid: function () {
                if (this.passwordRegister === null || this.passwordRegister === '') {
                    this.passwordValidTag = false;
                }
                if (this.passwordRegister !== null && this.passwordRegister !== '') {
                    if (regPassword.test(this.passwordRegister)) {
                        this.passwordValidMsg = '';
                        this.passwordValidTag = true;
                        return 'is-valid';
                    } else {
                        this.passwordValidMsg = '最少6位，包含至少1个大写字母，1个小写字母，1个数字，1个特殊字符';
                        this.passwordValidTag = false;
                        return 'is-invalid';
                    }
                }
            },
            confirmValid: function () {
                if (this.confirmPassword === null || this.confirmPassword === '') {
                    this.confirmValidTag = false;
                }
                if (
                    this.passwordRegister !== null && this.passwordRegister !== ''
                    &&
                    this.confirmPassword !== null && this.confirmPassword !== ''
                ) {
                    if (this.passwordRegister === this.confirmPassword) {
                        this.confirmValidMsg = '';
                        this.confirmValidTag = true;
                        return 'is-valid';
                    } else {
                        this.confirmValidMsg = '两次输入的密码不一致';
                        this.confirmValidTag = false;
                        return 'is-invalid';
                    }
                }
            },
            registerValid: function () {
                return true;
                // return this.emailValidTag && this.passwordValidTag && this.confirmValidTag;
            }
        },
    });
    new Vue({el: "#register-form"});
</script>