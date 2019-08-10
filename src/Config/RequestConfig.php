<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/2/19
 * Time: 2:28 AM
 */

namespace SimpleRequest\Config;

use SimpleRequest\Interfaces\RequestLogInterface;
use SimpleRequest\Traits\UrlParseInfoTrait;

class RequestConfig implements ConfigInterface
{
    use UrlParseInfoTrait;

    //为了代码简洁 这些属性不再设置　getter 和　setter 方法
    public $relative_path;

    public $queries_retrieve_from_url;

    public $domain;

    public $receive_params;

    public $illumination;

    public $complete_url;

    public $log_instance;

    public $request_method;

    public $request_options;

    public $request_expired_time;

    public function __construct(
        $illumination,
        $complete_url,
        $params,
        $method,
        RequestLogInterface $log_instance = null
    ) {
        $info = $this->url_parse_info($complete_url);

        [
            'domain'           => $domain,
            'path'             => $path,
            'retrieve_queries' => $retrieve_queries,
        ] = $info;

        $this->relative_path = $path;

        $this->domain = $domain;

        $this->queries_retrieve_from_url = $retrieve_queries;

        $this->params = $params;

        $this->illumination = $illumination;

        $this->complete_url = $complete_url;

        $this->log_instance = $log_instance;

        $this->request_method = $method;


        $query =
            array_merge($this->queries_retrieve_from_url, $params);

        //最大值的形式请求　方便调试
        $this->request_options = [
            'json'        => $params,
            'query'       => $query,
            'form_params' => $params,
        ];
    }

    /**
     * @return mixed
     */
    public function getRelativePath() : string
    {
        return $this->relative_path;
    }

    /**
     * @return mixed
     */
    public function getQueriesRetrieveFromUrl() : array
    {
        return $this->queries_retrieve_from_url;
    }

    /**
     * @return mixed
     */
    public function getDomain() : string
    {
        return $this->domain;
    }

    /**
     * @return mixed
     */
    public function getIllumination() : string
    {
        return $this->illumination;
    }

    public function getRequestOption() : array
    {
        return $this->request_options;
    }

    public static function getUrl($domain, $path)
    {
        $path = trim($path, '/');

        return sprintf("%s/%s", $domain, $path);
    }

    public function getCompleteUrl() : string
    {
        return $this->complete_url;
    }

    public function getLogInstance() : ?RequestLogInterface
    {
        return $this->log_instance;
    }

    public function getRequestMethod()
    {
        return $this->request_method;
    }

    public function getRequestExpiredTime()
    {
        return $this->request_expired_time;
    }
}