<script>
    const STATUS_WSC = {
        'success': 'success',
        'fail': 'fail',
        'error': 'error',
    };

    // 正则校验规则
    const REG_WSC = {
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
            'login': '/user/login',
        },
        'article': '/article',
    };
    const URI_API = {
        'user': {
            'register': '/api/user/register',
            'login': '/api/user/login',
            'login_check': '/api/user/login_check',
            'sign_calendar':'/api/user/sign_calendar',
        },
        'article': '/api/article',
        'comment': '/api/comment',
        'discussion': '/api/discussion',
        'image': '/api/image',
        'assess': '/api/assess',
    };

    const URI_CONFIG = {
        'create': '/create',
        'edit': '/edit',
        'update': '/update',
        'delete': '/delete',
        'user': '/user',
        'star': '/star',
        'bookmark': '/bookmark',
        'toggle': '/toggle',
    };

    const CLASSIFICATION_WSC = {
        'article': 'article',
        'create': 'create',
        'update': 'update',
    }
</script>
