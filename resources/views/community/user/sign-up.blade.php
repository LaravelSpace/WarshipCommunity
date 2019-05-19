@extends('community.app')

@section('body')
    <div class="row">
        <div id="sign-up" class="col-md-4 offset-md-4">
            <vue-sign-up></vue-sign-up>
        </div>
    </div>

    <template id="template-sign-up">
        <div class="px-3 py-3 border border-primary rounded">
            <div class="form-group text-center">
                <h3>用户注册</h3>
            </div>
            <hr class="my-4">
            <div class="form-group">
                <label for="register-identity">登录身份：</label>
                <div class="input-group mb-3">
                    <input type="text" id="register-identity" class="form-control" :class="identityValid"
                           placeholder="Email" v-model="identityRegister">
                    <div class="input-group-append">
                        <a tabindex="0" class="btn btn-outline-secondary" data-container="body"
                           data-toggle="popover" data-trigger="focus" data-placement="right"
                           data-content="第一次注册请使用邮箱作为登录身份">
                            <i class="fa fa-question-circle-o"></i>
                        </a>
                    </div>
                    <div class="valid-feedback">@{{ identityValidMsg }}</div>
                    <div class="invalid-feedback">@{{ identityValidMsg }}</div>
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
                            v-if="signUpValid" @click="signUpPost()">确认注册
                    </button>
                    <button type="button" class="btn btn-lg btn-primary px-5"
                            v-else disabled>确认注册
                    </button>
                    <button type="button" class="btn btn-lg btn-warning px-5"
                            @click="signUpReset()">重置表单
                    </button>
                </div>
            </div>
        </div>
    </template>
    <script>
        Vue.component('vue-sign-up', {
            template: '#template-sign-up',
            data: function () {
                return {
                    identityRegister: '',
                    identityValidMsg: '',
                    identityValidTag: false,
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
                signUpPost: function () {
                    let thisVue = this;
                    axios.post(
                        '/community/user/register/sign-up', {
                            'identity': thisVue.identityRegister,
                            'password': thisVue.passwordRegister,
                            'password_confirmation': thisVue.confirmPassword
                        }
                    ).then(function (response) {
                        console.debug(response.data);
                    }).catch(function (error) {
                        console.error(error.response.data);
                        console.error(error.response.status);
                        console.error(error.response.headers);
                    });
                },
                signUpReset: function () {
                    this.identityRegister = '';
                    this.identityValidMsg = '';
                    this.identityValidTag = false;
                    this.passwordRegister = '';
                    this.passwordValidMsg = '';
                    this.passwordValidTag = false;
                    this.confirmPassword = '';
                    this.confirmValidMsg = '';
                    this.confirmValidTag = false;
                }
            },
            computed: {
                identityValid: function () {
                    if (this.identityRegister === null || this.identityRegister === '') {
                        this.identityValidTag = false;
                    }
                    if (this.identityRegister !== null && this.identityRegister !== '') {
                        if (REG_EMAIL.test(this.identityRegister)) {
                            this.identityValidMsg = '';
                            this.identityValidTag = true;
                            return 'is-valid';
                        } else {
                            this.identityValidMsg = '不正确的邮箱地址';
                            this.identityValidTag = false;
                            return 'is-invalid';
                        }
                    }
                },
                passwordValid: function () {
                    if (this.passwordRegister === null || this.passwordRegister === '') {
                        this.passwordValidTag = false;
                    }
                    if (this.passwordRegister !== null && this.passwordRegister !== '') {
                        if (REG_PASSWORD.test(this.passwordRegister)) {
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
                signUpValid: function () {
                    return true; // todo 测试
                    // return this.identityValidTag && this.passwordValidTag && this.confirmValidTag;
                }
            },
        });
        new Vue({el: "#sign-up"});
    </script>
@endsection