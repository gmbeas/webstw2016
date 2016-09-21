<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 21-09-2016
 * Time: 11:43
 */

namespace Steward\Phpcart;
use Illuminate\Support\ServiceProvider;

class CarritoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('carrito', function() {
            return new \Steward\Phpcart\Carrito;
        });
    }
}