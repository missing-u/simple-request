<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/2/19
 * Time: 1:06 AM
 */

namespace SimpleRequest\Exceptions;

class FailRequestException extends BaseRequestException
{
    public function __construct()
    {
        $message = "请求失败";

        $code    = 0;

        parent::__construct($message, $code, null);
    }
}