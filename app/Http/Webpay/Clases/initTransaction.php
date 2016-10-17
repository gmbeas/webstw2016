<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 12:08
 */

namespace App\Http\Webpay\Clases;


class initTransaction
{
    /**
     * @var wsInitTransactionInput $wsInitTransactionInput
     * @access public
     */
    public $wsInitTransactionInput = null;

    /**
     * @param wsInitTransactionInput $wsInitTransactionInput
     * @access public
     */
    public function __construct($wsInitTransactionInput)
    {
        $this->wsInitTransactionInput = $wsInitTransactionInput;
    }
}