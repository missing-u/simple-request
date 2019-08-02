<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/1/19
 * Time: 3:18 PM
 */

namespace SimpleRequest;


class DoRequest
{
    public static function get($illumination, $url)
    {
        SimpleRequest::setRequestIllumination($illumination);

        SimpleRequest::get();
    }

    public static function post($illumination, $domain)
    {

    }

}