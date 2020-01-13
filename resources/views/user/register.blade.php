@extends('app')

@section('body')
    <div id="main-body" class="container" style="min-width: 1600px">
        <div class="row">
            <div id="vue-register" class="col-md-4 offset-md-4">
                <vue-register></vue-register>
            </div>
        </div>
    </div>

    <template id="template-register">
        <div class="px-3 py-3 border border-primary rounded">
            <div class="form-group text-center">
                <h3>用户注册</h3>
            </div>
            <hr class="my-4">
            <div class="form-group">
                <label for="register-name">昵称：</label>
                <div class="input-group mb-3">
                    <input id="register-name" type="text" class="form-control" placeholder="昵称"
                           :class="nameValid" v-model="name">
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
                <label for="register-identity">登录身份(邮箱)：
                    <button type="button" class="btn btn-link" @click="changeIdentity()">切换</button>
                </label>
                <div class="input-group mb-3">
                    <input type="text" id="register-identity" class="form-control" placeholder="邮箱地址"
                           :class="identityValid" v-model="identity">
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
                <label for="register-identity">登录身份(手机)：
                    <button type="button" class="btn btn-link" @click="changeIdentity()">切换</button>
                </label>
                <div class="input-group mb-3">
                    <input type="text" id="register-identity" class="form-control" placeholder="手机号码"
                           :class="identityValid" v-model="identity">
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
                    <input type="password" id="register-password" class="form-control" placeholder="登录密码"
                           :class="passwordValid" v-model="password">
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
                    <button type="button" class="btn btn-lg btn-primary px-5"
                            v-if="registerValid" @click="register()">确认注册
                    </button>
                    <button type="button" class="btn btn-lg btn-primary px-5"
                            v-else disabled>确认注册
                    </button>
                    <button type="button" class="btn btn-lg btn-warning px-5"
                            @click="reset()">重置表单
                    </button>
                </div>
            </div>
        </div>
    </template>
    <script>
        Vue.component("vue-register", {
            template: "#template-register",
            data: function () {
                return {
                    name: "", nameMsg: "", nameTag: false,
                    identity: "", identityMsg: "", identityTag: false,
                    isEmail: true,
                    password: "", passwordMsg: "", passwordTag: false
                }
            },
            created: function () {
                // 初始化 BootStrap 弹出框
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
                register: function () {
                    let thisVue = this;
                    axios.post(URI_API.user.register, {
                        "name": thisVue.name,
                        "identity": thisVue.identity,
                        "password": thisVue.password,
                        "is_email": thisVue.isEmail
                    }).then(function (response) {
                        if (response.data.data.user_id !== undefined) {
                            alert("user_id=" + response.data.data.user_id);
                        }
                    });
                },
                reset: function () {
                    this.name = "";
                    this.nameMsg = "";
                    this.nameTag = false;
                    this.identity = "";
                    this.identityMsg = "";
                    this.identityTag = false;
                    this.password = "";
                    this.passwordMsg = "";
                    this.passwordTag = false;
                }
            },
            computed: {
                nameValid: function () {
                    if (this.name !== null && this.name !== "") {
                        if (REG.name.test(this.name)) {
                            this.nameMsg = "";
                            this.nameTag = true;

                            return "is-valid";
                        } else {
                            this.nameMsg = REG_MESSAGE.name;
                            this.nameTag = false;

                            return "is-invalid";
                        }
                    } else {
                        this.nameTag = false;
                    }
                },
                identityValid: function () {
                    if (this.identity !== null && this.identity !== "") {
                        if (this.isEmail) {
                            if (REG.email.test(this.identity)) {
                                this.identityMsg = "";
                                this.identityTag = true;

                                return "is-valid";
                            } else {
                                this.identityMsg = REG_MESSAGE.email;
                                this.identityTag = false;

                                return "is-invalid";
                            }
                        } else {
                            if (REG.phone.test(this.identity)) {
                                this.identityMsg = "";
                                this.identityTag = true;

                                return "is-valid";
                            } else {
                                this.identityMsg = REG_MESSAGE.phone;
                                this.identityTag = false;

                                return "is-invalid";
                            }
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
                registerValid: function () {
                    return this.nameTag && this.identityTag && this.passwordTag;
                }
            },
        });
        new Vue({el: "#vue-register"});
    </script>
@endsection
