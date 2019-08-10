<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/1/19
 * Time: 9:57 AM
 */

namespace SimpleRequest;

trait UrlParseInfoTrait
{
    public static function url_parse_info($url)
    {
        $info = parse_url($url);

        $domain = sprintf('%s://%s', $info[ 'scheme' ], $info[ 'host' ]);

        $path = $info[ 'path' ];

        array_shift($path_arr);

        $query_str = $info[ 'query' ] ?? '';

        $query_arr = explode('&', $query_str);

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
