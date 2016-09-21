<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 21-09-2016
 * Time: 11:41
 */

namespace Steward\Phpcart\Facades;

use Illuminate\Support\Facades\Facade;

class Carrito extends Facade
{
    protected static function getFacadeAccessor() { return 'carrito'; }
}