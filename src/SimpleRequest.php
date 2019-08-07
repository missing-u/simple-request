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
class SimpleRequest
{
    public static function json_get($config, array $params) : array
    {
        SimpleRequestService::json_get($complete_path, $params);
    }

    //todo
    public function json_get_by_config($config, $data)
    {

    }
}
