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
class RobustRequest
{

    use CombineDomainWithPathTrait;

    /**
     * @param $illumination
     * @param $complete_url
     * @param $params
     * @return array
     * @throws Exceptions\FailRequestException
     */
    public static function json_get(
        $illumination,
        $complete_url,
        $params = [],
        $log_instance = null,
        $header = null
    ) : array {
        $method = 'GET';
        $config = RequestConfigFactory::request_config(
            $method,
            $illumination,
            $complete_url,
            $params,
            $log_instance,
            $header
        );

        return SimpleRequestService::json($config);
    }

    /**
     * @param $illumination
     * @param $complete_url
     * @param $params
     * @return array
     * @throws Exceptions\FailRequestException
     */
    public static function json_post(
        $illumination,
        $complete_url,
        $params = [],
        $log_instance = null,
        $header = null
    ) : array {
        $method = 'POST';

        $config = RequestConfigFactory::request_config(
            $method,
            $illumination,
            $complete_url,
            $params,
            $log_instance,
            $header
        );

        return SimpleRequestService::json($config);
    }

    /**
     * @param $illumination
     * @param $complete_url
     * @param $params
     * @return array
     * @throws Exceptions\FailRequestException
     */
    public static function json_get_separate(
        $illumination,
        $domain,
        $path,
        $params = [],
        $log_instance = null,
        $header = null
    ) : array {
        $complete_url = CombineDomainWithPathTool::main($domain, $path);

        return self::json_get($illumination, $complete_url, $params, $log_instance, $header);
    }

    /**
     * @param $illumination
     * @param $complete_url
     * @param $params
     * @return array
     * @throws Exceptions\FailRequestException
     */
    public static function json_post_separate(
        $illumination,
        $domain,
        $path,
        $params = [],
        $log_instance = null,
        $header = null
    ) : array {
        $complete_url = CombineDomainWithPathTool::main($domain, $path);

        return self::json_post($illumination, $complete_url, $params, $log_instance, $header);
    }


}
