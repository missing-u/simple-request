<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/1/19
 * Time: 9:57 AM
 */

namespace SimpleRequest\Traits;

trait UrlParseInfoTrait
{
    /**
     * @param $url
     * @return array 具体的每一项如果没有返回空
     */
    private function url_parse_info($url)
    {
        $info = parse_url($url);

        $default_scheme = 'http';
        
        $domain         = sprintf('%s://%s', $info[ 'scheme' ] ?? $default_scheme, $info[ 'host' ] ?? '');

        $path = $info[ 'path' ] ?? '';

        $query_str = $info[ 'query' ] ?? '';

        $query_arr = explode('&', $query_str);

        $query_arr = array_filter($query_arr);

        $retrieve_queries = [];

        array_map(function ($item) use (&$retrieve_queries) {

            $info = explode('=', $item);

            $key = $info[ 0 ] ?? '';

            $val = $info[ 1 ] ?? '';

            $retrieve_queries[ $key ] = $val;

        }, $query_arr);

        return [
            'domain'           => $domain,
            'path'             => $path,
            'retrieve_queries' => $retrieve_queries,
        ];
    }
}
