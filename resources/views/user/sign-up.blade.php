@extends('app')

@section('body')
    <div id="main-body" class="container" style="min-width: 1600px">
        <div class="row">
            <div id="sign-up" class="col-md-4 offset-md-4">
                <vue-sign-up></vue-sign-up>
            </div>
        </div>
    </div>

    <template id="template-sign-up">
        <div class="px-3 py-3 border border-primary rounded">
            <div class="form-group text-center">
                <h3>用户注册</h3>
            </div>
            <hr class="my-4">
            <div class="form-group">
                <label for="register-name">昵称：</label>
                <div class="input-group mb-3">
                    <input type="text" id="register-name" class="form-control" :class="nameValid"
                           placeholder="昵称" v-model="name">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" tabindex="0" data-trigger="focus"
                                data-container="body" data-toggle="popover" data-placement="right"
                                data-content="为自己起一个名字，要求 2~16 位的中文字符，英文字符，数字以及下划线">
                            <i class="fa fa-question-circle-o"></i>
                        </button>
                    </div>
                    <div class="valid-feedback">@{{ nameMsg }}</div>
                    <div class="invalid-feedback">@{{ nameMsg }}</div>
                </div>
            </div>
            <div class="form-group" v-if="isEmail">
                <label for="register-identity">登录身份(邮箱)：<a href="#" @click="changeIdentityModel()">切换</a></label>
                <div class="input-group mb-3">
                    <input type="text" id="register-identity" class="form-control" :class="identityValid"
                           placeholder="邮箱地址" v-model="identity">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" tabindex="0" data-trigger="focus"
                                data-container="body" data-toggle="popover" data-placement="right"
                                data-content="请填写作为登录身份的邮箱地址">
                            <i class="fa fa-question-circle-o"></i>
                        </button>
                    </div>
                    <div class="valid-feedback">@{{ identityMsg }}</div>
                    <div class="invalid-feedback">@{{ identityMsg }}</div>
                </div>
            </div>
            <div class="form-group" v-else="isEmail">
                <label for="register-identity">登录身份(手机)：<a href="#" @click="changeIdentityModel()">切换</a></label>
                <div class="input-group mb-3">
                    <input type="text" id="register-identity" class="form-control" :class="identityValid"
                           placeholder="手机号码" v-model="identity">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" tabindex="0" data-trigger="focus"
                                data-container="body" data-toggle="popover" data-placement="right"
                                data-content="请填写作为登录身份的手机号码">
                            <i class="fa fa-question-circle-o"></i>
                        </button>
                    </div>
                    <div class="valid-feedback">@{{ identityMsg }}</div>
                    <div class="invalid-feedback">@{{ identityMsg }}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="register-password">登录密码：</label>
                <div class="input-group mb-3">
                    <input type="password" id="register-password" class="form-control" :class="passwordValid"
                           placeholder="登录密码" v-model="password">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" tabindex="0" data-trigger="focus"
                                data-container="body" data-toggle="popover" data-placement="right"
                                data-content="要求 6~32 位，英文字符，特殊字符，数字以及下划线">
                            <i class="fa fa-question-circle-o"></i>
                        </button>
                    </div>
                    <div class="valid-feedback">@{{ passwordMsg }}</div>
                    <div class="invalid-feedback">@{{ passwordMsg }}</div>
                </div>
            </div>
            <hr class="my-4">
            <div class="form-group text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-lg btn-primary px-5" v-if="signUpValid"
                            @click="signUpSubmit()">确认注册
                    </button>
                    <button type="button" class="btn btn-lg btn-primary px-5" v-else disabled>确认注册</button>
                    <button type="button" class="btn btn-lg btn-warning px-5" @click="signUpReset()">重置表单</button>
                </div>
            </div>
        </div>
    </template>
    <script>
        Vue.component('vue-sign-up', {
            template: '#template-sign-up',
            data: function () {
                return {
                    name: '',
                    nameMsg: '',
                    nameTag: false,
                    identity: '',
                    identityMsg: '',
                    identityTag: false,
                    isEmail: true,
                    password: '',
                    passwordMsg: '',
                    passwordTag: false
                }
            },
            created: function () {
                // 初始化 BootStrap 弹出框
                $(document).ready(function () {
                    $('[data-toggle="popover"]').popover();
                })
            },
            methods: {
                changeIdentityModel: function () {
                    this.isEmail = !this.isEmail;
                    // 切换之后要重新初始化
                    $(document).ready(function () {
                        $('[data-toggle="popover"]').popover();
                    });
                },
                signUpSubmit: function () {
                    let thisVue = this;
                    axios.post(COMMUNITY_API_URL.user_sign_up, {
                        'name': thisVue.name,
                        'identity': thisVue.identity,
                        'is_email': thisVue.isEmail,
                        'password': thisVue.password
                    }).then(function (response) {
                        console.debug(response.data);
                    });
                },
                signUpReset: function () {
                    this.name = '';
                    this.nameMsg = '';
                    this.nameTag = false;
                    this.identity = '';
                    this.identityMsg = '';
                    this.identityTag = false;
                    this.password = '';
                    this.passwordMsg = '';
                    this.passwordTag = false;
                }
            },
            computed: {
                nameValid: function () {
                    if (this.name !== null && this.name !== '') {
                        if (REG_NAME.test(this.name)) {
                            this.nameMsg = '';
                            this.nameTag = true;
                            return 'is-valid';
                        } else {
                            this.nameMsg = REG_MESSAGE.REG_NAME;
                            this.nameTag = false;
                            return 'is-invalid';
                        }
                    } else {
                        this.nameTag = false;
                    }
                },
                identityValid: function () {
                    if (this.identity !== null && this.identity !== '') {
                        if (this.isEmail) {
                            if (REG_EMAIL.test(this.identity)) {
                                this.identityMsg = '';
                                this.identityTag = true;
                                return 'is-valid';
                            } else {
                                this.identityMsg = REG_MESSAGE.REG_EMAIL;
                                this.identityTag = false;
                                return 'is-invalid';
                            }
                        } else {
                            if (REG_MOBILE_PHONE.test(this.identity)) {
                                this.identityMsg = '';
                                this.identityTag = true;
                                return 'is-valid';
                            } else {
                                this.identityMsg = REG_MESSAGE.REG_MOBILE_PHONE;
                                this.identityTag = false;
                                return 'is-invalid';
                            }
                        }
                    } else {
                        this.identityTag = false;
                    }
                },
                passwordValid: function () {
                    if (this.password !== null && this.password !== '') {
                        if (REG_PASSWORD.test(this.password) && this.password.length <= 16) {
                            this.passwordMsg = '';
                            this.passwordTag = true;
                            return 'is-valid';
                        } else {
                            this.passwordMsg = REG_MESSAGE.REG_PASSWORD;
                            this.passwordTag = false;
                            return 'is-invalid';
                        }
                    } else {
                        this.passwordTag = false;
                    }
                },
                signUpValid: function () {
                    return this.nameTag && this.identityTag && this.passwordTag;
                }
            },
        });
        new Vue({el: '#sign-up'});
    </script>
@endsection