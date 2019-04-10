<script>
    // 邮箱校验正则
    var regEmail = new RegExp(/^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/);
    // 密码强度正则，最少6位，包含至少1个大写字母，1个小写字母，1个数字，1个特殊字符
    var regPassword = new RegExp(/^.*(?=.{6,})(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*? ]).*$/);
</script>