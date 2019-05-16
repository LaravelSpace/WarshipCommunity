<?php

namespace App\Exceptions;


use Throwable;

class ValidateException extends CommonException
{
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
        $this->attachData = $attachData;
        parent::__construct($message, $code, $attachData, $previous);
    }
}
