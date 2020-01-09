<script>
    const STATUS = {
        'success': 200,
        'fail': 400,
        'error': 500,
    };

    // 昵称校验正则，2~16 位的中文字符，英文字符，数字以及下划线
    // const REG_NAME = new RegExp(/^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|[a-zA-Z0-9_-]){2,16}$/);
    // 邮箱地址校验正则
    // const REG_EMAIL = new RegExp(/^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/);
    // 手机号码效验正则
    // const REG_PHONE = new RegExp(/^1[3456789]\d{9}$/);
    // 密码强度正则，6~32 位的英文字符，特殊字符，数字以及下划线
    // const REG_PASSWORD = new RegExp(/^([a-zA-Z0-9_-]|[!@#$%^&*? ]){6,32}$/);

    // 正则校验规则
    const REG = {
        // 昵称，2~16 位的中文字符，英文字符，数字以及下划线
        'name': new RegExp(/^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|[a-zA-Z0-9_-]){2,16}$/),
        // 邮箱地址
        'email': new RegExp(/^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/),
        // 手机号码
        'phone': new RegExp(/^1[3456789]\d{9}$/),
        // 密码强度，6~32 位的英文字符，特殊字符，数字以及下划线
        'password': new RegExp(/^([a-zA-Z0-9_-]|[!@#$%^&*? ]){6,32}$/)
    };

    // 正则校验错误提示
    const REG_MESSAGE = {
        'name': '仅支持 2~16 位的中文字符，英文字符，数字以及下划线',
        'email': '不正确的邮箱地址',
        'phone': '不正确的手机号码',
        'password': '仅支持 6~32 位，英文字符，特殊字符，数字以及下划线',
    };

    // 路由以及路由参数配置
    const URI_WEB = {
        'user': {
            'register': '/user/register',
            'login': '/user/login'
        },
        'role': '/role',
        'permission': '/permission',
        'article': '/article',
    };
    const URI_API = {
        'user': {
            'register': '/api/user/register',
            'login': '/api/user/login'
        },
        'article': '/api/article',
        'comment': '/api/comment',
        'image': '/api/image',
    };
    const URI_CONFIG = {
        'store': '/store',
        'edit': '/edit',
        'update': '/update',
        'destroy': '/destroy',
        'comment': '/comment',
    };
</script>
