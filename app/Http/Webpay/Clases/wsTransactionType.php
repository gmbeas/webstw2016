<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 12:11
 */

namespace App\Http\Webpay\Clases;


class wsTransactionType
{
    const __default = 'TR_NORMAL_WS';
    const TR_NORMAL_WS = 'TR_NORMAL_WS';
    const TR_NORMAL_WS_WPM = 'TR_NORMAL_WS_WPM';
    const TR_MALL_WS = 'TR_MALL_WS';
}