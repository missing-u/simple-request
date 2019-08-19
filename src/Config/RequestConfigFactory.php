<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/2/19
 * Time: 2:28 AM
 */

namespace SimpleRequest\Config;


use SimpleRequest\Traits\CombineDomainWithPathTrait;

class RequestConfigFactory
{
    use CombineDomainWithPathTrait;

    /**
     * @param $illumination
     * @param $complete_url
     * @param $params
     * @param $log_instance
     * @return ConfigInterface
     */
    public static function complete_path_config_of_post_method(
        $illumination,
        $complete_url,
        $params = [],
        $log_instance = null
    ) : ConfigInterface {

        $method = 'POST';

        return self::request_config(
            $method,
            $illumination,
            $complete_url,
            $params,
            $log_instance
        );

    }

    /**
     * @param $illumination
     * @param $complete_url
     * @param $params
     * @param $log_instance
     * @return ConfigInterface
     */
    public static function complete_path_config_of_get_method(
        $illumination,
        $complete_url,
        $params = [],
        $log_instance = null
    ) : ConfigInterface {

        $method = 'GET';

        return self::request_config(
            $method,
            $illumination,
            $complete_url,
            $params,
            $log_instance
        );

    }

    /**
     * @param $illumination
     * @param $complete_url
     * @param $params
     * @param $log_instance
     * @return ConfigInterface
     */
    public static function request_config(
        $method,
        $illumination,
        $complete_url,
        $params,
        $log_instance = null,
        $header = null,
        $request_expired_time = null
    ) : ConfigInterface {

        return new RequestConfig(
            $illumination,
            $complete_url,
            $params,
            $method,
            $log_instance,
            $header,
            $request_expired_time
        );
    }

}