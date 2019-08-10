<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/1/19
 * Time: 9:57 AM
 */

namespace SimpleRequest;

use SimpleRequest\Config\RequestConfigFactory;
use SimpleRequest\Traits\CombineDomainWithPathTool;
use SimpleRequest\Traits\CombineDomainWithPathTrait;

/**
 * Class SimpleRequestMediator
 * @package SimpleRequest
 */
class SimpleRequest
{

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

        return self::json_get($illumination, $complete_url, $params);
    }

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


}
