<script>
    // 为所有的 Axios 请求添加 headers
    // 这里要定义成对象(axios.config.headers)
    let axiosHeaders = {};

    // 获取 X-CSRF-TOKEN
    let eCsrfToken = document.head.querySelector('meta[name="csrf-token"]');
    let csrfToken = eCsrfToken.content;
    if (!gIsEmpty(csrfToken)) {
        axiosHeaders["X-CSRF-TOKEN"] = csrfToken;
    } else {
        console.error("CSRF-TOKEN not found");
    }

    // Axios 拦截器
    axios.interceptors.request.use(function (config) {
        // 在发送请求之前做些什么
        let wscToken = gGetWscToken();
        if (wscToken !== "") {
            axiosHeaders["Authorization"] = wscToken
        }
        config.headers = axiosHeaders;

        return config;
    }, function (error) {
        // 对请求错误做些什么
        console.error(error.response);

        return Promise.reject(error);
    });

    axios.interceptors.response.use(function (response) {
        // 对响应数据做点什么
        return response;
    }, function (error) {
        // 对响应错误做点什么
        console.error(error.response);

        return Promise.reject(error);
    });
</script>
