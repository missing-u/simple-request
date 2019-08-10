<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/1/19
 * Time: 9:57 AM
 */

namespace SimpleRequest;

<<<<<<< HEAD
use SimpleRequest\Config\RequestConfigFactory;
use SimpleRequest\Traits\CombineDomainWithPathTool;
use SimpleRequest\Traits\CombineDomainWithPathTrait;

/**
=======
/**
 * 只是叫中介者模式　并不是真实的实现了　中介者
 * 现在依旧在思考如何处理这个问题
>>>>>>> eb27a5aa1ccb0174213e45948cd7bf3d5f44b3d9
 * Class SimpleRequestMediator
 * @package SimpleRequest
 */
class SimpleRequest
{
<<<<<<< HEAD

    use CombineDomainWithPathTrait;

    /**
     * @param $illumination
     * @param $complete_url
     * @param $params
     * @return array
     * @throws Exceptions\FailRequestException
     */
    public static function json_post($illumination, $complete_url, $params) : array
    {
        $config = RequestConfigFactory::complete_path_config_of_post_method($illumination, $complete_url, $params);

        return SimpleRequestService::json($config);
    }

    /**
     * @param $illumination
     * @param $complete_url
     * @param $params
     * @return array
     * @throws Exceptions\FailRequestException
     */
    public static function json_get($illumination, $complete_url, $params) : array
    {
        $config = RequestConfigFactory::complete_path_config_of_get_method($illumination, $complete_url, $params);

        return SimpleRequestService::json($config);
    }

    /**
     * @param $illumination
     * @param $complete_url
     * @param $params
     * @return array
     * @throws Exceptions\FailRequestException
     */
    public static function json_get_separate($illumination, $domain, $path, $params) : array
    {
        $complete_url = CombineDomainWithPathTool::main($domain, $path);
=======
    public static function json_get($config, array $params) : array
    {
        SimpleRequestService::json_get($complete_path, $params);
    }

    //todo
    public function json_get_by_config($config, $data)
    {
>>>>>>> eb27a5aa1ccb0174213e45948cd7bf3d5f44b3d9

        return self::json_get($illumination, $complete_url, $params);
    }
<<<<<<< HEAD

    /**
     * @param $illumination
     * @param $complete_url
     * @param $params
     * @return array
     * @throws Exceptions\FailRequestException
     */
    public static function json_post_separate($illumination, $domain, $path, $params) : array
    {
        $complete_url = CombineDomainWithPathTool::main($domain, $path);

        return self::json_post($illumination, $complete_url, $params);
    }


=======
>>>>>>> eb27a5aa1ccb0174213e45948cd7bf3d5f44b3d9
}
