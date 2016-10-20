<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 17-10-2016
 * Time: 9:51
 */

namespace App\Http;

use Config;
use URL;

class Asset
{
    private static function getUrl($type, $file)
    {
        return URL::to(Config::get('assets.' . $type) . '/' . $file);
    }

    public static function css($file)
    {
        return self::getUrl('css', $file);
    }

    public static function img($file)
    {
        return self::getUrl('img', $file);
    }

    public static function js($file)
    {
        return self::getUrl('js', $file);
    }

    public static function skus($file)
    {
        return self::getUrl('skus', $file);
    }

    public static function otros($file)
    {
        return self::getUrl('otros', $file);
    }

    public static function arbol($file)
    {
        return self::getUrl('arbol', $file);
    }

}