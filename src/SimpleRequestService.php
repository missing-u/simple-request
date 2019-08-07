<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/1/19
 * Time: 9:57 AM
 */

namespace SimpleRequest;

//名字不合适
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
    }


}

