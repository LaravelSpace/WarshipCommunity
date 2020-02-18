<div id="vue-navbar">
    <vue-navbar></vue-navbar>
</div>
<template id="template-vue-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">冷月</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav col-md-6">
                <li class="nav-item mx-md-1">
                    <a class="nav-link" href="/article">帖子</a>
                </li>
            </ul>
            <ul class="navbar-nav col-md-3">
                <li class="nav-item">
                    <div class="form-inline">
                        <input class="form-control mx-md-1" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success mx-md-1" type="submit">
                            <i class="fa fa-search"></i> 搜索
                        </button>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav col-md-3 justify-content-end" v-if="notLogin">
                <li class="nav-item mx-md-1">
                    <a type="button" class="btn btn-outline-primary"
                       href="/user/login">登录</a>
                </li>
                <li class="nav-item mx-md-1">
                    <a type="button" class="btn btn-outline-primary"
                       href="/user/register">注册</a>
                </li>
            </ul>
            <ul class="navbar-nav col-md-3 justify-content-end" v-else="notLogin">
                <li class="nav-item mr-md-2">
                    <img src="" :src="avatar" class="rounded" style="width: 40px;height: 40px" alt="40x40">
                </li>
                <li class="nav-item dropdown mr-md-2 btn-group">
                    <button id="navbarDropdown" role="button" class="nav-link btn btn-outline-primary dropdown-toggle"
                            style="width: 150px;overflow: hidden"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @{{ name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" @click="logout()">退出登录</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
    Vue.component("vue-navbar", {
        template: "#template-vue-navbar",
        data: function () {
            return {
                notLogin: true,
                userId: 0,
                name: "",
                avatar: "",
            }
        },
        created: function () {
            let thisVue = this;
            axios.post(URI_API.user.login_check).then(function (response) {
                if (response.data.status === STATUS_WSC.success) {
                    thisVue.notLogin = false;
                    thisVue.userId = response.data.data.user_id;
                    thisVue.name = response.data.data.name;
                    thisVue.avatar = response.data.data.avatar;
                }
            }).catch(function (error) {
                if (error.response.status === 400) {
                    console.debug(error.response.data.message);
                }
            });
        },
        methods: {
            logout: function () {
            }
        }
    });
    new Vue({el: "#vue-navbar"});
</script>
