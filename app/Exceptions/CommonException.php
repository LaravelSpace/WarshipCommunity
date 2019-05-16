<?php

namespace App\Exceptions;


use Throwable;

class CommonException extends \Exception
{
    protected $attachData;

    public function __construct($message = "", $code = 0, $attachData = "", Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->attachData = $attachData;
    }

    public function getAttachData()
    {
        return $this->attachData;
    }
}
