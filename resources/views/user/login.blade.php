@extends('app')

@section('body')
    <div id="main-body" class="container" style="min-width: 1600px">
        <div class="row">
            <div id="vue-login" class="col-md-4 offset-md-4">
                <vue-login></vue-login>
            </div>
        </div>
    </div>

    <template id="template-login">
        <div class="px-3 py-3 border border-primary rounded">
            <div class="form-group text-center">
                <h3>用户登录</h3>
            </div>
            <hr class="my-4">
            <div class="form-group" v-if="isEmail">
                <label for="login-identity">登录身份(邮箱)：
                    <button type="button" class="btn btn-link" @click="changeIdentity()">切换</button>
                </label>
                <div class="input-group mb-3">
                    <input id="login-identity" type="text" class="form-control" placeholder="Email"
                           :class="identityValid" v-model="identity">
                    <div class="input-group-append">
                        <button tabindex="0" class="btn btn-outline-secondary" data-container="body"
                                data-toggle="popover" data-trigger="focus" data-placement="right"
                                data-content="请填写作为登录身份的邮箱地址">
                            <i class="fa fa-question-circle-o"></i>
                        </button>
                    </div>
                    <div class="valid-feedback">@{{ identityMsg }}</div>
                    <div class="invalid-feedback">@{{ identityMsg }}</div>
                </div>
            </div>
            <div class="form-group" v-else="isEmail">
                <label for="login-identity">登录身份(手机)：
                    <button type="button" class="btn btn-link" @click="changeIdentity()">切换</button>
                </label>
                <div class="input-group mb-3">
                    <input id="login-identity" type="text" class="form-control" placeholder="Email"
                           :class="identityValid" v-model="identity">
                    <div class="input-group-append">
                        <button tabindex="0" class="btn btn-outline-secondary" data-container="body"
                                data-toggle="popover" data-trigger="focus" data-placement="right"
                                data-content="请填写作为登录身份的手机号码">
                            <i class="fa fa-question-circle-o"></i>
                        </button>
                    </div>
                    <div class="valid-feedback">@{{ identityMsg }}</div>
                    <div class="invalid-feedback">@{{ identityMsg }}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="login-password">登录密码：</label>
                <div class="input-group mb-3">
                    <input type="password" id="login-password" class="form-control" placeholder="Password"
                           :class="passwordValid" v-model="password">
                    <div class="input-group-append">
                        <button tabindex="0" class="btn btn-outline-secondary" data-container="body"
                                data-toggle="popover" data-trigger="focus" data-placement="right"
                                data-content="密码最少6位，包含至少1个大写字母，1个小写字母，1个数字，1个特殊字符">
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
                    <button type="button" class="btn btn-lg btn-primary px-5"
                            v-if="loginValid" @click="login()">确认登录
                    </button>
                    <button type="button" class="btn btn-lg btn-primary px-5"
                            v-else disabled>确认登录
                    </button>
                    <button type="button" class="btn btn-lg btn-warning px-5"
                            @click="register()">前往注册
                    </button>
                </div>
            </div>
        </div>
    </template>
    <script>
        Vue.component("vue-login", {
            template: "#template-login",
            data: function () {
                return {
                    identity: "", identityMsg: "", identityTag: false,
                    isEmail: true,
                    password: "", passwordMsg: "", passwordTag: false
                }
            },
            created: function () {
                this.$nextTick(function () {
                    $('[data-toggle="popover"]').popover();
                });
            },
            methods: {
                changeIdentity: function () {
                    this.isEmail = !this.isEmail;
                    // 切换之后要重新初始化
                    this.$nextTick(function () {
                        $('[data-toggle="popover"]').popover();
                    });
                },
                login: function () {
                    let thisVue = this;
                    axios.post(URI_API.user.login, {
                        "identity": thisVue.identity,
                        "is_email": thisVue.isEmail,
                        "password": thisVue.password
                    }).then(function (response) {
                        if (response.data.status === STATUS.success) {
                            localStorage.setItem("user_id", response.data.data.user_id);
                            localStorage.setItem("wsc_token", response.data.data.token);
                        }
                    });
                },
                register: function () {
                    window.location.href = URI_WEB.user.register;
                }
            },
            computed: {
                identityValid: function () {
                    if (this.isEmail && this.identity !== null && this.identity !== "") {
                        if (REG.email.test(this.identity)) {
                            this.identityMsg = "";
                            this.identityTag = true;
                            return "is-valid";
                        } else {
                            this.identityMsg = REG_MESSAGE.email;
                            this.identityTag = false;
                            return "is-invalid";
                        }
                    } else if (!this.isEmail && this.identity !== null && this.identity !== "") {
                        if (REG.phone.test(this.identity)) {
                            this.identityMsg = "";
                            this.identityTag = true;
                            return "is-valid";
                        } else {
                            this.identityMsg = REG_MESSAGE.phone;
                            this.identityTag = false;
                            return "is-invalid";
                        }
                    } else {
                        this.identityTag = false;
                    }
                },
                passwordValid: function () {
                    if (this.password !== null && this.password !== "") {
                        if (REG.password.test(this.password) && this.password.length <= 16) {
                            this.passwordMsg = "";
                            this.passwordTag = true;
                            return "is-valid";
                        } else {
                            this.passwordMsg = REG_MESSAGE.password;
                            this.passwordTag = false;
                            return "is-invalid";
                        }
                    } else {
                        this.passwordTag = false;
                    }
                },
                loginValid: function () {
                    return this.identityTag && this.passwordTag;
                }
            }
        });
        new Vue({el: "#vue-login"});
    </script>
@endsection
