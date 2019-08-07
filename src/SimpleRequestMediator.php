<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/1/19
 * Time: 9:57 AM
 */

namespace SimpleRequest;

/**
 * 只是叫中介者模式　并不是真实的实现了　中介者
 * 现在依旧在思考如何处理这个问题
 * Class SimpleRequestMediator
 * @package SimpleRequest
 */
class SimpleRequestMediator
{
    //todo 暂时用不到
    public static function json_get_by_relative_path($relative_path)
    {

    }

    public static function set_request_illumination($config)
    {

    }

    public static function json_get(string $complete_path, array $params) : array
    {
        SimpleRequestDo::json_get($complete_path, $params);
    }

}
