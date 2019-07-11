@extends('community.app')

@section('body')
    <div class="row">
        <div id="sign-in" class="col-md-4 offset-md-4">
            <vue-sign-in></vue-sign-in>
        </div>
    </div>

    <template id="template-sign-in">
        <div class="px-3 py-3 border border-primary rounded">
            <div class="form-group text-center">
                <h3>用户登录</h3>
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
                           data-content="目前只可以使用邮箱作为登录身份">
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
            <hr class="my-4">
            <div class="form-group text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-lg btn-primary px-5"
                            v-if="signInValid" @click="signInSubmit()">确认登录
                    </button>
                    <button type="button" class="btn btn-lg btn-primary px-5"
                            v-else disabled>确认登录
                    </button>
                    <button type="button" class="btn btn-lg btn-warning px-5"
                            @click="signUpPage()">前往注册
                    </button>
                </div>
            </div>
        </div>
    </template>
    <script>
        Vue.component('vue-sign-in', {
            template: '#template-sign-in',
            data: function () {
                return {
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
                    $(document).ready(function () {
                        $('[data-toggle="popover"]').popover();
                    })
                },
                signInSubmit: function () {
                    let thisVue = this;
                    axios.post(COMMUNITY_URL.users_sign_in, {
                        'identity': thisVue.identityRegister,
                        'password': thisVue.passwordRegister
                    }).then(function (response) {
                        if (response.data.status === STATUS_SUCCESS) {
                            window.location.href = '/';
                        }
                    });
                },
                signUpPage: function () {
                    window.location.href = COMMUNITY_URL.users_sign_up;
                }
            }
        });
        new Vue({el: '#sign-in'});
    </script>
@endsection