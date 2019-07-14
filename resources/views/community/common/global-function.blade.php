<script>
    function gSplitUrl(url){
        let urlArray = url.split('?');
        let urlOnly = urlArray[0];

        return urlOnly.split('/');
    }

    function gGetParameterFromUrl(url, parameterName) {
        let urlArray = url.split('?');
        if (urlArray.length > 1) {
            let parameterString = urlArray[1];
            let parameterArray = parameterString.split('&');
            for (let i = 0; i < parameterArray.length; i++) {
                let parameterObject = parameterArray[i].split('=');
                if (parameterObject !== null && parameterName === parameterObject[0]) {
                    return parameterObject[1];
                }
            }
        }
        return '';
    }
</script>