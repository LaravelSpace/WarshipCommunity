<template id="template-register-form">
    <div class="px-3 py-3 border border-primary rounded">
        <div class="form-group">
            <label for="register-email">Email</label>
            <input type="text" id="register-email" class="form-control" :class="emailValid" placeholder="Email"
                   v-model="emailRegister">
            <div class="valid-feedback">
                @{{  emailValidMsg }}
            </div>
        </div>
        <div class="form-group">
            <label for="register-password">Password</label>
            <input type="text" id="register-password" class="form-control" :class="passwordValid" placeholder="Password"
                   v-model="passwordRegister">
            <div class="valid-feedback">
                @{{  passwordValidMsg }}
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
                emailValid: '',
                emailValidMsg: '',
                passwordRegister: '',
                passwordValid: '',
                passwordValidMsg: ''
            }
        },
        created: function () {
            this.init();
        },
        methods: {
            init: function () {

            },
        }
    });
    new Vue({el: "#register-form"});
</script>