<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/10/19
 * Time: 11:30 PM
 */

namespace SimpleRequest\Traits;


class CombineDomainWithPathTool
{
    use CombineDomainWithPathTrait;

    public static function main($domain, $path)
    {
        return (new self())->get_complete_url($domain, $path);
    }
}