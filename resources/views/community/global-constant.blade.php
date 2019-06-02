<script>
    const STATUS_SUCCESS = "SUCCESS";

    // 邮箱校验正则
    const REG_EMAIL = new RegExp(/^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/);
    // 密码强度正则，最少6位，包含至少1个大写字母，1个小写字母，1个数字，1个特殊字符
    const REG_PASSWORD = new RegExp(/^.*(?=.{6,})(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*? ]).*$/);

    const COMMUNITY_URL = {
        "need_data": "data=1",
        "articles": "/articles",
    };
</script>