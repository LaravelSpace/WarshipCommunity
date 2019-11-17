<script>
    // 将路由去掉参数后，以 '/' 分割并转化为数组
    function gGetUrI(url) {
        let urlArr = url.split('?');

        return urlArr[0].split('/');
    }

    // 获取路由中的参数
    function gGetParam(url, param) {
        let urlArr = url.split('?');
        if (urlArr.length > 1) {
            let paramStr = urlArr[1];
            let paramArr = paramStr.split('&');
            for (let i = 0; i < paramArr.length; i++) {
                let paramObj = paramArr[i].split('=');
                if (paramObj !== null && param === paramObj[0]) {
                    return paramObj[1];
                }
            }
        }
        return '';
    }
</script>
