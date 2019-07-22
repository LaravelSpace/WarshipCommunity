<?php

namespace App\Exceptions;


use Throwable;

class ValidateException extends CommonException
{
    public const SWITCH_NON_EXISTENT_CASE = '[SWITCH 结构不存在该 CASE]>>';

    /**
     * ValidateException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param string         $attachData
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, $attachData = "", Throwable $previous = null)
    {
        parent::__construct($message, $code, $attachData, $previous);
    }
}
