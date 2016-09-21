<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 21-09-2016
 * Time: 11:41
 */

namespace Steward\Phpcart;

use Illuminate\Support\Collection as IlluminateCollection;
use Exception;

class Coleccion extends IlluminateCollection
{
    /**
     * All items
     *
     * @var Array
     */
    protected $items;
    /**
     * Required fields. User must supply these fields
     *
     * @var array
     */
    protected $requiredFields = [
        'id',
        'nombre',
        'precio',
        'cantidad',
        'foto',
        'unidad',
        'skuid'
    ];
    public function setItems(array $items)
    {
        $this->items = $items;
    }
    public function getItems()
    {
        return $this->items;
    }
    /**
     * Find an item in cart
     *
     * @return array
     */
    public function findItem($key)
    {
        return isset($this->items[$key])? $this->items[$key] : null;
    }
    public function has($item)
    {
        if ($this->findItem($item['id'])) {
            return true;
        }
        return false;
    }
    public function insert(array $item)
    {
        $this->validateItem($item);
        $this->items[$item['id']] = (object) $item;
        return $this->items;
    }
    // Alias of insert
    public function update(array $item)
    {
        return $this->insert($item);
    }
    /**
     * Verify all required fields are exist
     * @param  Array  $item
     * @return Void
     */
    public function validateItem(array $item)
    {
        $fields = array_diff_key(array_flip($this->requiredFields), $item);
        if ($fields) {
            throw new Exception('Some required fields missing: ' . implode(",", array_keys($fields)));
        }
        if ($item['cantidad'] < 1) {
            throw new Exception('Quantity can not be less than 1');
        }
        if (! is_numeric($item['precio'])) {
            throw new Exception('Price must be a numeric number');
        }
    }
}