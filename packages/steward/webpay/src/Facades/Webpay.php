<?php

/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 10:19
 */

namespace Steward\Webpay\Facades;

class Webpay extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'webpay';
    }
}