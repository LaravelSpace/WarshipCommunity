<script>
    // 这段代码为所有的 Ajax 和 Axios 请求添加 CSRF-TOKEN，因此需要在所有的请求发起之前执行
    // 别放在 $(document).ready(function () {}) 里面，也别放在页面底部
    var csrfToken = document.head.querySelector('meta[name="csrf-token"]');
    var apiToken = document.head.querySelector('meta[name="api-token"]');
    if (csrfToken !== null && csrfToken !== '' && apiToken !== null && apiToken !== '') {
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        //         'Authorization': $('meta[name="api-token"]').attr('content')
        //     }
        // });
        window.jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken.content,
                'Authorization': apiToken.content
            }
        });
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.content;
    } else {
        if (csrfToken === null && csrfToken !== '') {
            console.error('CSRF token not found');
        } else if (apiToken === null && apiToken !== '') {
            console.error('API token not found');
        }
    }
</script>