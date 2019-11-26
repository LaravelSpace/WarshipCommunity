@extends('app')

@section('body')
    <div class="row">
        <div id="vue-permission" class="col-md-8 offset-md-2">
            <vue-permission></vue-permission>
        </div>
    </div>

    <template id="template-permission">
        <div>
            <hr class="my-4">
            <div>
                <div>
                    <ul class="list-unstyled" v-if="vifShow">
                        <li class="media" v-for="role in roleList">
                            <p>@{{ role.name }}</p>
                        </li>
                    </ul>
                </div>
                <hr class="my-4">
                <div class="form-row">
                    <div class="col col-md-4">
                        <div class="input-group mb-3">
                            <input type="text" id="role-name" class="form-control"
                                   placeholder="角色名称" v-model="roleName">
                            <div class="input-group-append">
                                <a tabindex="0" class="btn btn-outline-secondary" data-container="body"
                                   data-toggle="popover" data-trigger="focus" data-placement="top"
                                   data-content="角色名称">
                                    <i class="fa fa-question-circle-o"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" id="role-describe" class="form-control"
                                   placeholder="角色描述" v-model="roleDescribe">
                            <div class="input-group-append">
                                <a tabindex="0" class="btn btn-outline-secondary" data-container="body"
                                   data-toggle="popover" data-trigger="focus" data-placement="top"
                                   data-content="角色描述">
                                    <i class="fa fa-question-circle-o"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-2">
                        <button type="button" class="btn btn-primary px-5" @click="roleSubmit()">新建角色</button>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div>
                <div>
                    <ul class="list-unstyled" v-if="vifShow">
                        <li class="media" v-for="permission in permissionList">
                            <p>@{{ permission.name }}</p>
                        </li>
                    </ul>
                </div>
                <hr class="my-4">
                <div class="form-row">
                    <div class="col col-md-4">
                        <div class="input-group mb-3">
                            <input type="text" id="permission-name" class="form-control"
                                   placeholder="权限名称" v-model="permissionName">
                            <div class="input-group-append">
                                <a tabindex="0" class="btn btn-outline-secondary" data-container="body"
                                   data-toggle="popover" data-trigger="focus" data-placement="top"
                                   data-content="权限名称">
                                    <i class="fa fa-question-circle-o"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" id="permission-describe" class="form-control"
                                   placeholder="权限描述" v-model="permissionDescribe">
                            <div class="input-group-append">
                                <a tabindex="0" class="btn btn-outline-secondary" data-container="body"
                                   data-toggle="popover" data-trigger="focus" data-placement="top"
                                   data-content="权限描述">
                                    <i class="fa fa-question-circle-o"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-2">
                        <button type="button" class="btn btn-primary px-5" @click="permissionSubmit()">新建权限</button>
                    </div>
                </div>
            </div>
            <hr class="my-4">
        </div>
    </template>
    <script>
        Vue.component('vue-permission', {
            template: '#template-permission',
            data: function () {
                return {
                    vifShow: false,
                    roleName: '',
                    roleDescribe: '',
                    roleList: [],
                    permissionName: '',
                    permissionDescribe: '',
                    permissionList: []
                }
            },
            created: function () {
                this.init();
            },
            methods: {
                init: function () {
                    this.getRoleList();
                    this.getPermissionList();
                    $(document).ready(function () {
                        $('[data-toggle="popover"]').popover();
                    })
                },
                getRoleList: function () {
                    let thisVue = this;
                    let url = COMMUNITY_URL.roles + '?' + COMMUNITY_URL.need_data;
                    axios.get(url).then(function (response) {
                        thisVue.roleList = response.data.data;
                        if (thisVue.roleList.length > 0) {
                            thisVue.vifShow = true;
                        }
                    }).catch(function (error) {
                        console.error(error.response);
                    });
                },
                getPermissionList: function () {
                    let thisVue = this;
                    let url = COMMUNITY_URL.permissions + '?' + COMMUNITY_URL.need_data;
                    axios.get(url).then(function (response) {
                        thisVue.permissionList = response.data.data;
                        if (thisVue.permissionList.length > 0) {
                            thisVue.vifShow = true;
                        }
                    }).catch(function (error) {
                        console.error(error.response);
                    });
                },
                roleSubmit: function () {
                    let thisVue = this;
                    axios.post(COMMUNITY_URL.roles, {
                        'name': thisVue.roleName,
                        'describe': thisVue.roleDescribe
                    }).then(function (response) {
                        if (response.data.status === STATUS_SUCCESS) {

                        }
                    });
                },
                permissionSubmit: function () {
                    let thisVue = this;
                    axios.post(COMMUNITY_URL.permissions, {
                        'name': thisVue.permissionName,
                        'describe': thisVue.permissionDescribe
                    }).then(function (response) {
                        if (response.data.status === STATUS_SUCCESS) {

                        }
                    });
                }
            }
        });
        new Vue({el: '#vue-permission'});
    </script>
@endsection
