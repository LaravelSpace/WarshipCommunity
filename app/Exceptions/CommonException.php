<?php

namespace App\Exceptions;


use Throwable;

class CommonException extends \Exception
{
    protected $attachment;

    public function __construct($message = "", $code = 0, $attachment = "", Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->attachment = $attachment;
    }

    public function getAttachment()
    {
        return $this->attachment;
    }
}
