<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/1/19
 * Time: 9:57 AM
 */

namespace SimpleRequest;

//名字不合适
use GuzzleHttp\Client;
use SimpleRequest\Config\ConfigInterface;
use SimpleRequest\Exceptions\FailRequestException;
use SimpleRequest\Traits\ResponseTrait;
use SimpleRequest\Traits\UrlParseInfoTrait;
use Throwable;

class SimpleRequestService
{
    use UrlParseInfoTrait;

    use ResponseTrait;

    /**
     * @param ConfigInterface $config
     * @return array
     * @throws FailRequestException
     */
    public static function json(ConfigInterface $config) : array
    {
        $method = $config->getRequestMethod();

        $timeout_limit = $config->getRequestExpiredTime();

        $options = $config->getRequestOption();

        $domain = $config->getDomain();

        $default_config = [
            'base_uri' => $domain,
            'timeout'  => $timeout_limit,
            'verify'   => false,//没有这个参数　https 会有问题
        ];

        $client = new Client($default_config);

        $complete_url = $config->getCompleteUrl();

        try {
            $response = $client->$method(
                $complete_url, $options
            );
        } catch (Throwable $exception) {
            throw new FailRequestException($exception, $config);
        }

        return static::tentativeParseResponse($response, $config);
    }


}

