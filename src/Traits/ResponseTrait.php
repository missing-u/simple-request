<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/1/19
 * Time: 9:57 AM
 */

namespace SimpleRequest\Traits;

use Psr\Http\Message\ResponseInterface;
use SimpleRequest\Config\ConfigInterface;

trait ResponseTrait
{
    public static function tentativeParseResponse(ResponseInterface $response, ConfigInterface $config) : array
    {
        $contents = $response->getBody()->getContents();

        $log_instance = $config->getLogInstance();

        if ($log_instance !== null) {
            $log_instance->record($response, $config);
        }

        $contents = self::formatResponse($contents);

        return json_decode($contents, true);
    }

    public static function formatResponse($contents)
    {
        $contents = trim($contents);
        //bom 头本身 3 个字节　所以　如果含有bom 头　字符串一定大于等于3字节
        //否则即不包含bom头　
        if (strlen($contents) >= 3) {
            //去掉bom 头
            $contents = self::removeBom($contents);
        }

        return $contents;
    }

    /**
     * @param $contents
     * @return string
     */
    public static function removeBom($contents) : string
    {
        //str_replace("\ufeff", "", $contents); 不能直接这样　会被识别为多个字符
        $charset[ 1 ] = $contents[ 0 ];
        $charset[ 2 ] = $contents[ 1 ];
        $charset[ 3 ] = $contents[ 2 ];

        $contents_trim_bom = $contents;

        if (ord($charset[ 1 ]) == 239 && ord($charset[ 2 ]) == 187 && ord($charset[ 3 ]) == 191) {
            $contents_trim_bom = substr($contents, 3);
        }

        return $contents_trim_bom;
    }
}
