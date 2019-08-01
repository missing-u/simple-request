<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/1/19
 * Time: 9:57 AM
 */

namespace SimpleRequest;

use App\Models\Constants;
use App\Modules\Exceptions\RequestFailException;
use App\Modules\Request\SimpleRequestInterface;
use GuzzleHttp\Client;
use Throwable;

class SimpleRequest
{
    public static $request_domain = null;

    /**
     * @var string 请求说明
     */
    public static $request_illumination;

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

    public static function get($path, $get_params = [])
    {
        // TODO: Implement get() method.
    }


    public static function tentativeParseResponse($response) : array
    {
        return json_decode($response->getBody()->getContents(), true);
    }

    public static function wrapPostParams($post_params)
    {
        // TODO: Implement wrapPostParams() method.
    }


    /**
     * @param $path
     * @param array $post_data
     * @return mixed
     * @throws RequestFailException
     */
    public static function form_params_post_with_query($path, $params, array $url_params = []) : array
    {
        $domain = static::getRequestDomain();

        $info = self::retrieveFromPathParams($path);
        [
            'path'                      => $path,
            'retrieve_params_from_path' => $retrieve_params_from_path,
        ] = $info;

        $client = new Client([
            'base_uri' => $domain,
            'timeout'  => Constants::TIME_OUT_LIMIT,
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
            throw new RequestFailException(self::getRequestIllumination(), $url, $options, $exception,'POST');
        }

        return static::tentativeParseResponse($response);

    }

    /**
     * @param $path
     * @param array $post_data
     * @return mixed
     * @throws RequestFailException
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


    /**
     * @param $path
     * @param array $post_data
     * @return mixed
     * @throws RequestFailException
     */
    public static function json_post($path, $params, $queries = []) : array
    {
        $domain = static::getRequestDomain();

        $info = self::retrieveFromPathParams($path);
        [
            'path'                      => $path,
            'retrieve_params_from_path' => $retrieve_params_from_path,
        ] = $info;

        $client = new Client([
            'base_uri' => $domain,
            'timeout'  => Constants::TIME_OUT_LIMIT,
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
            throw new RequestFailException(self::getRequestIllumination(), $url, $params, $exception,'POST');
        }

        return static::tentativeParseResponse($response);

    }

    public static function retrieveFromPathParams($path)
    {

        $path_arr = explode('?', $path);

        $path = $path_arr[ 0 ];

        array_shift($path_arr);

        $retrieve_params_from_path = [];

        array_map(function ($item) use (&$retrieve_params_from_path) {
            try {
                $info = explode('=', $item);

//                $val = trim($info[ 1 ], '/');
                $val = $info[ 1 ];

                $key = $info[ 0 ];

                $retrieve_params_from_path[ $key ] = $val;

            } catch (Throwable $exception) {

            }

        }, $path_arr);

        return [
            'path'                      => $path,
            'retrieve_params_from_path' => $retrieve_params_from_path,
        ];
    }

}