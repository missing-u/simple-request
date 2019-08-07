<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/1/19
 * Time: 9:57 AM
 */

namespace SimpleRequest;

use GuzzleHttp\Client;
use SimpleRequest\Exceptions\FailRequestException;
use Throwable;

class SimpleRequest
{
    use SimpleRequestTrait;

    private static $request_domain = null;

    /**
     * @var string 请求说明
     */
    private static $request_illumination;

    /**
     * @return string
     */
    public static function getRequestIllumination() : string
    {
        return self::$request_illumination;
    }

    /**
     * @param null $request_domain
     */
    public static function setRequestDomain($request_domain) : void
    {
        self::$request_domain = $request_domain;
    }

    /**
     * @return string
     */
    public static function getRequestDomain() : string
    {
        return self::$request_domain;
    }


    /**
     * @param $path
     * @param array $post_data
     * @return mixed
     * @throws FailRequestException
     */
    public static function json_post($path, $params, $queries = []) : array
    {
        $domain = static::getRequestDomain();

        $info = self::url_parse_info($path);
        [
            'path'                      => $path,
            'retrieve_params_from_path' => $retrieve_params_from_path,
        ] = $info;

        $client = new Client([
            'base_uri' => $domain,
            'timeout'  => RequestConfig::TIME_OUT_LIMIT,
            'verify'   => false,//没有这个参数　https 会有问题
        ]);

        $url = static::getUrl($domain, $path);

        try {
            $response = $client->post(
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

    public static function tentativeParseResponse($response) : array
    {
        $contents = $response->getBody()->getContents();

        //laravel 某些情况下返回中带有空格
        //尝试过　如果 如果　json_decode(" "); 则得到的值是　null
        //所有　这里使用　trim 并不影响
        $contents = trim($contents);

        return json_decode($contents, true);
    }

    /**
     * @param $path
     * @param array $post_data
     * @return mixed
     * @throws FailRequestException
     */
    public static function form_params_post_with_query($path, $params, array $url_params = []) : array
    {
        $domain = static::getRequestDomain();

        $info = self::url_parse_info($path);
        [
            'path'                      => $path,
            'retrieve_params_from_path' => $retrieve_params_from_path,
        ] = $info;

        $client = new Client([
            'base_uri' => $domain,
            'timeout'  => RequestConfig::TIME_OUT_LIMIT,
            'verify'   => false,//没有这个参数　https 会有问题
        ]);

        $url = static::getUrl($domain, $path);

        try {
            $options  = [
                'form_params' => $params,
                'query'       => array_merge($retrieve_params_from_path, $url_params),
            ];
            $response = $client->post(
                $url,
                $options
            );
        } catch (Throwable $exception) {
            throw new FailRequestException(self::getRequestIllumination(), $url, $options, $exception, 'POST');
        }

        return static::tentativeParseResponse($response);

    }

    /**
     * @param $path
     * @param array $post_data
     * @return mixed
     * @throws FailRequestException
     */
    public static function form_params_post($path, $params) : array
    {
        return self::form_params_post_with_query($path, $params);
    }

    public static function getUrl($domain, $path)
    {
        $path = trim($path, '/');

        return sprintf("%s/%s", $domain, $path);
    }

    /**
     * @param string $request_illumination
     */
    public static function setRequestIllumination(string $request_illumination) : void
    {
        self::$request_illumination = $request_illumination;
    }



}