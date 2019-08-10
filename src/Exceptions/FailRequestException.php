<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/2/19
 * Time: 1:06 AM
 */

namespace SimpleRequest\Exceptions;

use SimpleRequest\Config\ConfigInterface;
use Throwable;

class FailRequestException extends BaseRequestException
{
    public $request_config;

    public $contain_exception;

    public function getRequestConfig() : ConfigInterface
    {
        return $this->request_config;
    }

    public function __construct(Throwable $throwable, ConfigInterface $config)
    {
        $message = "请求失败";

        $this->request_config = $config;

        $this->contain_exception = $throwable;

        parent::__construct($message);
    }
}