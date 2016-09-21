<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 21-09-2016
 * Time: 11:43
 */

namespace Steward\Phpcart;

interface CarritoInterface
{
    public function setCarrito($nombre);

    public function getCarrito();

    public function add(Array $producto);

    public function update(Array $producto);

    public function remove($id);

    public function getItems();

    public function get($id);

    public function getSumSku($id);

    public function has($id);

    public function clear();

    public function totalCantidad();

    public function getTotal();
}