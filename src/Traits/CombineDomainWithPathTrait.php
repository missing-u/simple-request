<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/10/19
 * Time: 11:30 PM
 */

namespace SimpleRequest\Traits;


trait CombineDomainWithPathTrait
{
    public function get_complete_url($domain, $path)
    {
        $path = trim($path, '/');

        return sprintf('%s/%s', $domain, $path);
    }
}