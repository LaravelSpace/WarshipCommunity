<?php

namespace App\Exceptions;


use Throwable;

class ServiceException extends CommonException
{
    /**
     * ServiceException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param string         $attachment
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, $attachment = "", Throwable $previous = null)
    {
        parent::__construct($message, $code, $attachment, $previous);
    }
}
