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
                <label for="register-name">昵称：</label>
                <div class="input-group mb-3">
                    <input type="text" id="register-name" class="form-control" :class="nameValid"
                           placeholder="昵称" v-model="nameRegister">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" tabindex="0" data-trigger="focus"
                                data-container="body" data-toggle="popover" data-placement="right"
                                data-content="为自己起一个名字，要求 2~16 位的中文字符，英文字符，数字以及下划线">
                            <i class="fa fa-question-circle-o"></i>
                        </button>
                    </div>
                    <div class="valid-feedback">@{{ nameValidMsg }}</div>
                    <div class="invalid-feedback">@{{ nameValidMsg }}</div>
                </div>
            </div>
            <div class="form-group" v-if="identityEmail">
                <label for="register-identity">登录身份(邮箱)：<a href="#" @click="changeIdentityModel()">切换</a></label>
                <div class="input-group mb-3">
                    <input type="text" id="register-identity" class="form-control" :class="identityValid"
                           placeholder="邮箱地址" v-model="identityRegister">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" tabindex="0" data-trigger="focus"
                                data-container="body" data-toggle="popover" data-placement="right"
                                data-content="请填写作为登录身份的邮箱地址">
                            <i class="fa fa-question-circle-o"></i>
                        </button>
                    </div>
                    <div class="valid-feedback">@{{ identityValidMsg }}</div>
                    <div class="invalid-feedback">@{{ identityValidMsg }}</div>
                </div>
            </div>
            <div class="form-group" v-else="identityEmail">
                <label for="register-identity">登录身份(手机)：<a href="#" @click="changeIdentityModel()">切换</a></label>
                <div class="input-group mb-3">
                    <input type="text" id="register-identity" class="form-control" :class="identityValid"
                           placeholder="手机号码" v-model="identityRegister">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" tabindex="0" data-trigger="focus"
                                data-container="body" data-toggle="popover" data-placement="right"
                                data-content="请填写作为登录身份的手机号码">
                            <i class="fa fa-question-circle-o"></i>
                        </button>
                    </div>
                    <div class="valid-feedback">@{{ identityValidMsg }}</div>
                    <div class="invalid-feedback">@{{ identityValidMsg }}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="register-password">登录密码：</label>
                <div class="input-group mb-3">
                    <input type="password" id="register-password" class="form-control" :class="passwordValid"
                           placeholder="登录密码" v-model="passwordRegister">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" tabindex="0" data-trigger="focus"
                                data-container="body" data-toggle="popover" data-placement="right"
                                data-content="要求 6~32 位，英文字符，特殊字符，数字以及下划线">
                            <i class="fa fa-question-circle-o"></i>
                        </button>
                    </div>
                    <div class="valid-feedback">@{{ passwordValidMsg }}</div>
                    <div class="invalid-feedback">@{{ passwordValidMsg }}</div>
                </div>
            </div>
            <hr class="my-4">
            <div class="form-group text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-lg btn-primary px-5"
                            v-if="signUpValid" @click="signUpSubmit()">确认注册
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
                    nameRegister: '',
                    nameValidMsg: '',
                    nameValidTag: false,
                    identityEmail: true,
                    identityRegister: '',
                    identityValidMsg: '',
                    identityValidTag: false,
                    passwordRegister: '',
                    passwordValidMsg: '',
                    passwordValidTag: false
                }
            },
            created: function () {
                this.init();
            },
            methods: {
                init: function () {
                    // 初始化 BootStrap 弹出框
                    $(document).ready(function () {
                        $('[data-toggle="popover"]').popover();
                    })
                },
                changeIdentityModel: function () {
                    this.identityEmail = !this.identityEmail;
                    // 切换之后要重新初始化
                    $(document).ready(function () {
                        $('[data-toggle="popover"]').popover();
                    })
                },
                signUpSubmit: function () {
                    let thisVue = this;
                    axios.post(COMMUNITY_URL.users_sign_up, {
                        'name': thisVue.nameRegister,
                        'identity_email': thisVue.identityEmail,
                        'identity': thisVue.identityRegister,
                        'password': thisVue.passwordRegister,
                    }).then(function (response) {
                        console.debug(response.data);
                    });
                },
                signUpReset: function () {
                    this.nameRegister = '';
                    this.nameValidMsg = '';
                    this.nameValidTag = false;
                    this.identityRegister = '';
                    this.identityValidMsg = '';
                    this.identityValidTag = false;
                    this.passwordRegister = '';
                    this.passwordValidMsg = '';
                    this.passwordValidTag = false;
                }
            },
            computed: {
                nameValid: function () {
                    if (this.nameRegister !== null && this.nameRegister !== '') {
                        if (REG_NAME.test(this.nameRegister)) {
                            this.nameValidMsg = '';
                            this.nameValidTag = true;
                            return 'is-valid';
                        } else {
                            this.nameValidMsg = REG_MESSAGE.REG_NAME;
                            this.nameValidTag = false;
                            return 'is-invalid';
                        }
                    } else {
                        this.nameValidTag = false;
                    }
                },
                identityValid: function () {
                    if (this.identityRegister !== null && this.identityRegister !== '') {
                        if (this.identityEmail) {
                            if (REG_EMAIL.test(this.identityRegister)) {
                                this.identityValidMsg = '';
                                this.identityValidTag = true;
                                return 'is-valid';
                            } else {
                                this.identityValidMsg = REG_MESSAGE.REG_EMAIL;
                                this.identityValidTag = false;
                                return 'is-invalid';
                            }
                        } else {
                            if (REG_MOBILE_PHONE.test(this.identityRegister)) {
                                this.identityValidMsg = '';
                                this.identityValidTag = true;
                                return 'is-valid';
                            } else {
                                this.identityValidMsg = REG_MESSAGE.REG_MOBILE_PHONE;
                                this.identityValidTag = false;
                                return 'is-invalid';
                            }
                        }
                    } else {
                        this.identityValidTag = false;
                    }
                },
                passwordValid: function () {
                    if (this.passwordRegister !== null && this.passwordRegister !== '') {
                        if (REG_PASSWORD.test(this.passwordRegister)
                            && this.passwordRegister.length <= 16
                        ) {
                            this.passwordValidMsg = '';
                            this.passwordValidTag = true;
                            return 'is-valid';
                        } else {
                            this.passwordValidMsg = REG_MESSAGE.REG_PASSWORD;
                            this.passwordValidTag = false;
                            return 'is-invalid';
                        }
                    } else {
                        this.passwordValidTag = false;
                    }
                },
                signUpValid: function () {
                    return this.nameValidTag && this.identityValidTag && this.passwordValidTag;
                }
            },
        });
        new Vue({el: '#sign-up'});
    </script>
@endsection