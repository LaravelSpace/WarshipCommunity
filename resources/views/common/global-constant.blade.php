<script>
    const STATUS_SUCCESS = 'SUCCESS';

    // 邮箱地址校验正则
    const REG_EMAIL = new RegExp(/^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/);
    // 手机号码效验正则
    const REG_MOBILE_PHONE = new RegExp(/^1[3456789]\d{9}$/);
    // 昵称校验正则，2~16 位的中文字符，英文字符，数字以及下划线
    const REG_NAME = new RegExp(/^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|[a-zA-Z0-9_-]){2,16}$/);
    // 密码强度正则，6~32 位的英文字符，特殊字符，数字以及下划线
    const REG_PASSWORD = new RegExp(/^([a-zA-Z0-9_-]|[!@#$%^&*? ]){6,32}$/);
    // 正则校验错误提示
    const REG_MESSAGE = {
        'REG_EMAIL': '不正确的邮箱地址',
        'REG_MOBILE_PHONE': '不正确的手机号码',
        'REG_NAME': '仅支持 2~16 位的中文字符，英文字符，数字以及下划线',
        'REG_PASSWORD': '仅支持 6~32 位，英文字符，特殊字符，数字以及下划线',
    };

    // 路由以及路由参数配置
    const COMMUNITY_URL = {
        'store': '/store',
        'edit': '/edit',
        'update': '/update',
        'destroy': '/destroy',
        'comment': '/comment',
    };

    const COMMUNITY_WEB_URL = {
        'users_sign_up': '/users/register/sign-up',
        'users_sign_in': '/users/register/sign-in',
        'users_sign_out': '/users/register/sign-out',
        'users_sign_check': '/users/register/sign-check',
        'roles': '/roles',
        'permissions': '/permissions',

        'article': '/article',
    };

    const COMMUNITY_API_URL = {

        'article': '/api/article',
        'comment': '/api/comment',
    };
</script>