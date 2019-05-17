<?php

namespace App\Http\Controllers;


class WebController extends Controller
{
    /**
     * @var int 状态码
     */
    protected $statusCode;

    /**
     * WebController constructor.
     */
    public function __construct()
    {
        $this->statusCode = config('constant.http_success_code');
    }

    /**
     * 获取状态码
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * 设置状态码
     *
     * @param $statusCode
     *
     * @return $this
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this; // 返回 $this 提供链式操作
    }

    /**
     * 请求成功，返回结果
     *
     * @param array $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(array $data)
    {
        if ($data['status'] === config('constant.success')) {
            return $this->responseSuccess(isset($data['data']) ? $data['data'] : []);
        } else {
            return $this->responseFailed(isset($data['data']) ? $data['data'] : []);
        }
    }

    /**
     * 请求成功，返回结果
     *
     * @param array $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess(array $data = [])
    {
        return response()->json([
            'status'      => config('constant.success'),
            'status_code' => $this->getStatusCode(),
            'data'        => $data,
        ]);
    }

    /**
     * 请求成功，返回错误
     *
     * @param array $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseFailed(array $data = [])
    {
        return response()->json([
            'status'      => config('constant.fail'),
            'status_code' => $this->getStatusCode(),
            'data'        => $data
        ]);
    }

    /**
     * 请求失败，返回错误码和错误信息
     *
     * @param int    $errorCode
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError(int $errorCode, string $message)
    {
        return response()->json([
            'error_code'    => $errorCode,
            'error_message' => $message
        ], $errorCode);
    }

    /**
     * 请求失败，返回 404 错误
     *
     * @param string $message
     *
     * @return mixed
     */
    public function responseNotFound(string $message = 'Not Found')
    {
        // 链式操作需要在前面执行的方法返回 $this
        return $this->setStatusCode(404)->responseError(404, $message);
    }
}

//                                   ,\`.
//                   .........     .,@/O@@].
//              ..]/@OOOOOOO@\]`..,@/...\@OO\.
//          ..,/@@@@@@@@OoO@@OO@@..,@].,@@O/.
//      ...,@@@OOOOOOO@@@@@@@OO@/. .OO@@@/...            ..
//    ..,@@@@OoooooO@@@@@@@@@@@@@@@@^.*@OO@@OO]...      ,@\..
// .../@@@@OOOOO@@@@@@@@@@@@@@@@@/[[[[[[[[\OO@@^=@@@O]],@@@@@\`.
// ./@@@@OO@@@@OOOO@@@@[`****]]]/\]`...*******[[O@@]@@O\@@@@@@@@@\.
// @@@@O@@@@OO@@@O/[***,oOOOO/[...*******]]/o\`***[\O@@]]`*[\@O@@@@@\.
// @@@@@@@@@@OOoooooooo]oo]]*,****]OOOOOo/[[[[[********[ooooOO],\@@@@@@\`..
// @@@@@@@OOooO@OooooooooooooOO@OOo\`******..**************,\oooOO],\@@@@/.
// @@@@@@@@@@OOO\@OooOOOOO@@@Oooooooooooo\`*****]oOO^*****.****\oooO\.\@..
// @@@@@@OoO^O@OO/@@@[@@@@@OOOO@@@OOOooOO@@@OOOO[O/***o**....***,/[oo@\.\\/..
// @@@@OooO@O^\@@@^O@@@@@@@OO@@@@@@@/[\@@@@@/**,OoOo]O`********/o****/oO@@@OO.
// @@@Ooo@@OO@\=O/O\,/@@@@O[[******]@@@O[,O..*,OoO@oOOoo\****,O`****/`/,ooO@@@\`..    .,]`..
// @@Ooo@@O@@O@@/`,^...........]O/[`**......**@O@@OOOoooooooOO*****=^=o***\oO\\\\O\...=/@OO@^.
// @@oo@@@@@@@/[@@@@@@@@@@@@@@\*[`..........*/@@^@O@ooooooO@OOoo`,OO,O****..[oO@/\/@OO@@@`.
// @@o@@@@@@@,@@@@/*********,\@@@@`,`.......,@@`=O@OoooooO@O@@OooO`OOo*.....*oooO/@\]/OO..
// @@@@@@`@^`.@@`***/@@@@@@@@\`*,@@@\,\.....@@`*@@Oooooo@@@@/@OO@^*@Oo^**...*\O^,o@O\]OOOO`..
// @@@@@..`.../***=@@O..=@@@@@@@`*=@@^......@`.=@OooooOOO@@`*@O@/.*@@OO******=O^.*/@@@@@OoOO`.
// @@@/...........@@@@@@@@@@@@@@@**@@^.....=/../@OooOO@@@/*.=@@@..,\@@Oo\*****o^*.O,@@@@@@@@OO`
// @@@............=@@@@@@@@@@@@@@**.^[`....,...@@OoOO@@@`...=@@^...@@@Ooooo`**=O**O*=@@@@@@@@@@
// @@^..............[[@@@@@@@@@/...............@@OOO@@@.....,@@.[[@@@@OooooOo]=O^*=^/O@@@@@@@@@
// O@.....................[@/`.................@@@@@@/.......@/....@@@@oooo@OoOOO//ooo@@@@@@@@@
// =`..........................................@@@@@/........@^....\@O@@OoO@OoOOOoOOooO@@@@@@@o
// ............................................=@=@/....[[[[,=^....=@o@O@@@OOoOOOoOOooO@@@@@@@o
// ..............................................,@`...,\@@@]`^[`..=@.@@O@^@OOO@OooOoooO@@@@@@o
// ...............................................^..[[[[[[[@@@@`,..`.=@@/=@OOO@ooOOoooO@@@@@@o
// ....................................................*******,\@@]....@@`.=@OO@ooOOoooO@@@@@@o
// ...................................`*.............../@@@@@@`**@@@`..,^..=@O@OooOOoooO@@@@@@o
// ...................................................@@`.../@@@@*\@@^..^..=@@@ooooooooO@@@@@@O
// ..................................................=@@@@@@@@@@@@`=@@^,...=@@OooooO@oo@@@@@@@O
// ..................,@@@@@`[.].....................,/@@@@@@@@@@@@^*@@@`...,@OoOOoO@OOO@@@O@O@O
// ................,@@@@@@@@\....``....................\@@@@@@@@@@^*=@@^...,OoO@OO@@OOO@@@@OO@O
// ..............=@@@@@@@@@@@@@]....`....................,@@@@@@@@`*=@@\...OoO@OO@@OO@@@OoooO@O
// ............./@@OooooOOO@@@@@@@@@]/`....................,@@@@[***=@@...OO@@OO@Ooo@@@@OoooO@O
// ............/ooooooooooooooO@@@@@@@@@.....................,\..**,@@/.=@@@@OO@Ooo@@@@OooooOOO
// ............OooooooooooooooooO@@@@@@@@.............................,@@/OOoO@OoooO@OOoooooOO@
// ............oooooooooooooooooooO@@@@@`............................/@`,OOoO@OoooO@OOooO@OO@@O
// ............ooooooooooooooooooooO@@@/.........................../[../OoooOooooO@@ooO@@OO@@OO
// ............\oooooooooooooooooooo@@/.........................,`...,@Ooooooooo@@@OoO@@O@@@O@@
// .............\ooooooooooooooooooo@/.............................,@OooooooooO@@@OoO@@@@@@O@@@
