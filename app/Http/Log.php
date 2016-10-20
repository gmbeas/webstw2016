<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 17-10-2016
 * Time: 11:55
 */

namespace App\Http;


use Storage;

class Log
{

    private static function create($nv)
    {
        $date = date('dmY_His');
        return $nv . "_" . $date . ".txt";
    }

    public static function setLogTBK($nv, $contenido)
    {
        $archivo = self::create($nv);
        Storage::append($archivo, $contenido);
    }
}