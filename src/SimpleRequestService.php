<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/1/19
 * Time: 9:57 AM
 */

namespace SimpleRequest;

//名字不合适
<<<<<<< HEAD
use GuzzleHttp\Client;
use SimpleRequest\Config\ConfigInterface;
use SimpleRequest\Config\RequestConfigConstants;
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

        $timeout_limit = RequestConfigConstants::time_out_limit;

        $options = $config->getRequestOption();

        $domain = $config->getDomain();

        $client = new Client([
            'base_uri' => $domain,
            'timeout'  => $timeout_limit,
            'verify'   => false,//没有这个参数　https 会有问题
        ]);

        $complete_url = $config->getCompleteUrl();

        try {
            $response = $client->$method(
                $complete_url, $options
            );
        } catch (Throwable $exception) {
            throw new FailRequestException($exception, $config);
        }

        return static::tentativeParseResponse($response, $config);
=======
class SimpleRequestService
{

    use UrlParseInfoTrait;

    public static function json_get(string $complete_path, array $params) : array
    {
        $options = [];

        if ( !empty($params)) {
            [
                'json'  => $params,
                'query' => array_merge($queries, $retrieve_params_from_path),
            ] = $params;
        }
        $domain = static::getRequestDomain();

        $info = self::retrieveFromPathParams($path);
        [
            'path'                      => $path,
            'retrieve_params_from_path' => $retrieve_params_from_path,
        ] = $info;

        $client = new Client([
            'base_uri' => $domain,
            'timeout'  => RequestConfigConstants::TIME_OUT_LIMIT,
            'verify'   => false,//没有这个参数　https 会有问题
        ]);

        $url = static::getUrl($domain, $path);

        try {
            $response = $client->get(
                $url,
                [
                    'json'  => $params,
                    'query' => array_merge($queries, $retrieve_params_from_path),
                ]
            );
        } catch (Throwable $exception) {
            throw new FailRequestException(self::getRequestIllumination(), $url, $params, $exception, 'POST');
        }

        return static::tentativeParseResponse($response);
>>>>>>> eb27a5aa1ccb0174213e45948cd7bf3d5f44b3d9
    }


}

