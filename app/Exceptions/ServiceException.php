<?php

namespace App\Exceptions;


use Throwable;

class ServiceException extends CommonException
{
    public function __construct($message = "", $code = 0, $attachData = "", Throwable $previous = null)
    {
        parent::__construct($message, $code, $attachData, $previous);
    }
}
