<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 21-09-2016
 * Time: 11:40
 */

namespace Steward\Phpcart;

use Exception;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Session\Session;

class Carrito implements CarritoInterface
{

    const CARTSUFFIX = '_cart';
    /**
     * The Cart session,
     *
     * @var \Symfony\Component\HttpFoundation\Session\Session
     */
    protected $session;
    /**
     * Manage cart items
     *
     * @var \Steward\Phpcart\Collection
     */
    protected $collection;
    /**
     * Cart name
     *
     * @var string
     */
    protected $name = "phpcart";
    /**
     * Construct the class.
     *
     * @return void
     */
    public function __construct($name = null)
    {
        $this->session = new Session();
        $this->collection = new Coleccion();
        if ($name) {
            $this->setCarrito($name);
        }
    }
    public function setCarrito($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Cart name can not be empty.');
        }
        $this->name = $name . self::CARTSUFFIX;
    }
    public function getCarrito()
    {
        return $this->name;
    }
    /**
     * Set the current cart name
     *
     * @param  string  $instance  Cart instance name
     * @return \Steward\Phpcart\Cart
     */
    public function nombred($name)
    {
        $this->setCarrito($name);
        return $this;
    }
    /**
     * Add an item to the cart.
     *
     * @param  Array  $product
     * @return \Steward\Phpcart\Collection
     */
    public function add(Array $product)
    {
        $this->collection->validateItem($product);
        // If item already added, increment the quantity
        if ($this->has($product['id'])) {
            $item = $this->get($product['id']);
            return $this->updateCantidad($item->id, $item->cantidad + $product['cantidad']);
        }
        $this->collection->setItems($this->session->get($this->getCarrito(), []));
        $items = $this->collection->insert($product);
        $this->session->set($this->getCarrito(), $items);
        return $this->collection->make($items);
    }
    /**
     * Update an item.
     *
     * @param  Array  $product
     * @return \Steward\Phpcart\Collection
     */
    public function update(Array $product)
    {
        $this->collection->setItems($this->session->get($this->getCarrito(), []));
        if (! isset($product['id'])) {
            throw new Exception('id is required');
        }
        if (! $this->has($product['id'])) {
            throw new Exception('There is no item in shopping cart with id: ' . $product['id']);
        }
        $item = array_merge((array) $this->get($product['id']), $product);
        $items = $this->collection->insert($item);
        $this->session->set($this->getCarrito(), $items);
        return $this->collection->make($items);
    }
    /**
     * Update quantity of an Item.
     *
     * @param mixed $id
     * @param int $quantity
     *
     * @return \Steward\Phpcart\Collection
     */
    public function updateCantidad($id, $quantity)
    {
        $item = (array) $this->get($id);
        $item['cantidad'] = $quantity;
        return $this->update($item);
    }
    /**
     * Update price of an Item.
     *
     * @param mixed $id
     * @param float $price
     *
     * @return \Steward\Phpcart\Collection
     */
    public function updatePrecio($id, $price)
    {
        $item = (array) $this->get($id);
        $item['precio'] = $price;
        return $this->update($item);
    }
    /**
     * Remove an item from the cart.
     *
     * @param  mixed $id
     * @return \Steward\Phpcart\Collection
     */
    public function remove($id)
    {
        $items = $this->session->get($this->getCarrito(), []);
        unset($items[$id]);
        $this->session->set($this->getCarrito(), $items);
        return $this->collection->make($items);
    }
    /**
     * Helper wrapper for cart items.
     *
     * @return \Steward\Phpcart\Collection
     */
    public function items()
    {
        return $this->getItems();
    }
    /**
     * Get all the items.
     *
     * @return \Steward\Phpcart\Collection
     */
    public function getItems()
    {
        return $this->collection->make($this->session->get($this->getCarrito()));
    }
    /**
     * Get a single item.
     * @param  $id
     *
     * @return Array
     */
    public function get($id)
    {
        $this->collection->setItems($this->session->get($this->getCarrito(), []));
        return $this->collection->findItem($id);
    }
    /**
     * Check an item exist or not.
     * @param  $id
     *
     * @return boolean
     */
    public function has($id)
    {
        $this->collection->setItems($this->session->get($this->getCarrito(), []));
        return $this->collection->findItem($id)? true : false;
    }
    /**
     * Get the number of Unique items in the cart
     *
     * @return int
     */
    public function count()
    {
        $items = $this->getItems();
        return $items->count();
    }
    /**
     * Get the total amount
     *
     * @return float
     */
    public function getTotal()
    {
        $items = $this->getItems();
        return $items->sum(function($item) {
            return $item->precio * $item->cantidad;
        });
    }


    public function getBruto(){
        $items = $this->getItems();
        $total = $items->sum(function($item) {
            return $item->precio * $item->cantidad;
        });

        $neto = $total / 1.19;
        $iva = $total - $neto;
        $salida['neto'] = (int)round($neto);
        $salida['iva'] = (int)round($iva);
        $salida['bruto'] = (int)$total;

        return $salida;
    }



    /**
     * Get the total quantities of items in the cart
     *
     * @return int
     */
    public function totalCantidad()
    {
        $items = $this->getItems();
        return $items->sum(function($item) {
            return $item->quantity;
        });
    }


    public function getSumSku($id)
    {
        $sku = $this->get($id);
        return $sku->cantidad * $sku->precio;
    }


    /**
     * Clone a cart to another
     *
     * @param  mix $cart
     *
     * @return void
     */
    public function copy($cart)
    {
        if (is_object($cart)) {
            if (! $cart instanceof \Steward\Phpcart\Carrito) {
                throw new InvalidArgumentException("Argument must be an instance of " . get_class($this));
            }
            $items = $this->session->get($cart->getCarrito(), []);
        } else {
            if (! $this->session->has($cart . self::CARTSUFFIX)) {
                throw new Exception('Cart does not exist: ' . $cart);
            }
            $items = $this->session->get($cart . self::CARTSUFFIX, []);
        }
        $this->session->set($this->getCarrito(), $items);
    }
    /**
     * Alias of clear (Deprecated)
     *
     * @return void
     */
    public function flash()
    {
        $this->clear();
    }
    /**
     * Empty cart
     *
     * @return void
     */
    public function clear()
    {
        $this->session->remove($this->getCarrito());
    }
}