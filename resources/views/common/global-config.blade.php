<script>
    // 为所有的 Axios 请求添加 headers
    let axiosHeaders = {};
    let csrfToken = document.head.querySelector('meta[name="csrf-token"]');
    if (csrfToken !== null && csrfToken !== "") {
        axiosHeaders["X-CSRF-TOKEN"] = csrfToken.content;
    } else {
        console.error("CSRF token not found");
    }

    axios.interceptors.request.use(function (config) {
        // 在发送请求之前做些什么
        let wscToken = localStorage.getItem("wsc_token");
        if (wscToken !== null && wscToken !== "") {
            axiosHeaders["Authorization"] = wscToken
        }
        config.headers = axiosHeaders;

        return config;
    }, function (error) {
        // 对请求错误做些什么
        return Promise.reject(error);
    });

    axios.interceptors.response.use(function (response) {
        // 对响应数据做点什么
        return response;
    }, function (error) {
        // 对响应错误做点什么
        console.debug(error);
        // alert(error.response.data.message);

        return Promise.reject(error);
    });
</script>
