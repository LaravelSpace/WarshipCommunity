<script>
    function gIsEmpty(param) {
        if (param === undefined) {
            // console.debug("param is undefined");
            return true;
        }
        if (param === null) {
            // console.debug("param is null");
            return true;
        }
        if (typeof param === "string") {
            if (param === "") {
                // console.debug("param is empty string");
                return true;
            }
        }
        if (typeof param === "number") {
            if (isNaN(param)) {
                // console.debug("param is NaN");
                return true;
            }
        }
        if (typeof param === "object") {
            // object
            if (JSON.stringify(param) === "{}") {
                // console.debug("param is empty object");
                return true;
            }
            // array
            if (JSON.stringify(param) === "[]") {
                // console.debug("param is empty array");
                return true;
            }
        }
    }

    // 将路由去掉参数后，以 '/' 分割并转化为数组
    function gGetUrIArr(url) {
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
                if (!gIsEmpty(paramObj) && param === paramObj[0]) {
                    return paramObj[1];
                }
            }
        }
        return "";
    }

    // 获取用户 ID
    function gGetUserId() {
        let userId = localStorage.getItem("user_id");
        if (!gIsEmpty(userId)) {
            return userId;
        }
        return 0;
    }

    // 获取用户 token
    function gGetWscToken() {
        let token = localStorage.getItem("wsc_token");
        if (!gIsEmpty(token)) {
            return token;
        }
        return "";
    }
</script>
