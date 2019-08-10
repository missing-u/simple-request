<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/2/19
 * Time: 2:28 AM
 */

namespace SimpleRequest\Config;


use SimpleRequest\Interfaces\RequestLogInterface;

interface ConfigInterface
{
    public function getRelativePath() : string;

    public function getQueriesRetrieveFromUrl() : array;

    public function getDomain() : string;

    public function getRequestOption() : array;

    public function getIllumination() : string;

    public function getCompleteUrl() : string;

    public function getLogInstance() : ?RequestLogInterface;

    public function getRequestMethod();
}