<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/2/19
 * Time: 1:06 AM
 */

namespace SimpleRequest\Exceptions;

use Exception;
use Throwable;

class BaseRequestException extends Exception
{
    public function __construct(string $message = "请求发生错误", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}