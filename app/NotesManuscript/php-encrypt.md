# PHP 加密解密问题

## 场景 1

在应用过程中出现需要在 `PHP 5.6` 版本加密然后在 `PHP 7.1` 版本解密的情况。
由于 `mcrypt_encrypt()`,`mcrypt_decrypt()` 等部分函数在 `PHP 7.1` 版本被移除，而且直接使用 `PHP 5.6` 版本 `mcrypt_encrypt()` 函数得到的加密串和 `PHP 7.1` 版本 `openssl_encrypt()` 函数得到的加密串结果不同，所以不能直接使用函数进行加密解密操作。
处理方案是在 `PHP 5.6` 环境下加密时，需要使用 `[\0]` 进行补位。

## 场景 1 的解决方案

`PHP 5.6` 版本的加密部分

```php
$password = 123456;
$encrypt_key = '11111111111111111111111111111132';
$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
$pad = $blockSize - (strlen($password) % $blockSize);
$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
$encryptText = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $encrypt_key, $password . str_repeat(chr($pad), $pad), MCRYPT_MODE_ECB, $iv);
$encryptTextBase64 = base64_encode($encryptText);
```

`PHP 7.1` 版本的解密部分

```
$encryptText = base64_decode($encryptTextBase64);
$encrypt_key = '11111111111111111111111111111132';
$decryptText = openssl_decrypt($encryptText, 'AES-256-ECB', $key, OPENSSL_RAW_DATA);
$password = $decryptText;
```

经过测试这两组代码可以得到正确的结果。