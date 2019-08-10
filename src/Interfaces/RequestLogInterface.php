<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/10/19
 * Time: 11:03 PM
 */

namespace SimpleRequest\Interfaces;


use Psr\Http\Message\ResponseInterface;
use SimpleRequest\Config\ConfigInterface;

interface RequestLogInterface
{
    public function record(ResponseInterface $response, ConfigInterface $config);

    public static function init();
}