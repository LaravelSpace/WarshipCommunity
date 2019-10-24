<template id="template-vue-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">冷月</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav col-md-6 mr-5">
                <li class="nav-item active">
                    <a class="nav-link" href="/article">帖子</a>
                </li>
            </ul>
            <ul class="navbar-nav col-md-3 mr-5">
                <li class="nav-item">
                    <div class="form-inline">
                        <input class="form-control mr-md-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fa fa-search"></i> 搜索
                        </button>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav col-md-2" v-if="notSignIn">
                <li class="nav-item mr-md-2">
                    <a type="button" class="btn btn-outline-primary"
                       href="/users/register?target=sign-in">登录</a>
                </li>
                <li class="nav-item mr-md-2">
                    <a type="button" class="btn btn-outline-primary"
                       href="/users/register?target=sign-up">注册</a>
                </li>
            </ul>
            <ul class="navbar-nav col-md-2" v-else="notSignIn">
                <li class="nav-item mr-md-2">
                    <img src="" :src="avatar" class="rounded" style="width: 40px;height: 40px" alt="40x40">
                </li>
                <li class="nav-item dropdown mr-md-2">
                    <button class="nav-link btn btn-outline-primary dropdown-toggle" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @{{ name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" @click="signOut()">退出登录</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
    Vue.component('vue-navbar', {
        template: '#template-vue-navbar',
        data: function () {
            return {
                notSignIn: true,
                userId: '',
                name: '',
                avatar: '',
            }
        },
        created: function () {
            this.signCheck();
        },
        methods: {
            signCheck: function () {
                let thisVue = this;
                axios.get(COMMUNITY_URL.users_sign_check).then(function (response) {
                    if (response.data.status === STATUS_SUCCESS) {
                        let $responseData = response.data.data;
                        if ($responseData.identity_id !== null
                            && $responseData.identity_id !== 0
                            && $responseData.identity_id !== '0'
                        ) {
                            thisVue.notSignIn = false;
                            thisVue.userId = $responseData.identity_id;
                            thisVue.name = $responseData.name;
                            thisVue.avatar = $responseData.avatar;
                        }
                    }
                }).catch(function (error) {
                    console.error(error.response);
                });
            },
            signOut: function () {
                axios.get(COMMUNITY_URL.users_sign_out).then(function (response) {
                    if (response.data.status === STATUS_SUCCESS) {
                        window.location.reload();
                    }
                }).catch(function (error) {
                    console.error(error.response);
                });
            }
        }
    });
    new Vue({el: '#vue-navbar'});
</script>