<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/2/19
 * Time: 1:06 AM
 */

namespace SimpleRequest\Exceptions;

class ParsePathInfoException extends BaseRequestException
{
    public function __construct($path)
    {
        $message = sprintf(
            "从: %s 中解析路径错误", $path
        );

        $code = 10000;

        parent::__construct($message, $code, null);
    }
}