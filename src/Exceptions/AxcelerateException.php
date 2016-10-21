<?php

namespace FlipNinja\Axcelerate\Exceptions;

class AxcelerateException extends \Exception
{
    protected $detail;

    public function __construct($title = null, $code = null, $detail = '')
    {
        $this->detail = $detail;
        parent::__construct($title, $code);
    }

    public function getDetail()
    {
        return $this->detail;
    }
}
