<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 10:09
 */

namespace Steward\Webpay\Clases;


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