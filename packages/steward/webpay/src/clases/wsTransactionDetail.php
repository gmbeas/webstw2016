<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 10:12
 */

namespace Steward\Webpay\Clases;


class wsTransactionDetail
{
    /**
     * @var float $sharesAmount
     * @access public
     */
    public $sharesAmount = null;
    /**
     * @var int $sharesNumber
     * @access public
     */
    public $sharesNumber = null;
    /**
     * @var float $amount
     * @access public
     */
    public $amount = null;
    /**
     * @var string $commerceCode
     * @access public
     */
    public $commerceCode = null;
    /**
     * @var string $buyOrder
     * @access public
     */
    public $buyOrder = null;

    /**
     * @param float $sharesAmount
     * @param int $sharesNumber
     * @param float $amount
     * @param string $commerceCode
     * @param string $buyOrder
     * @access public
     */
    public function __construct($sharesAmount, $sharesNumber, $amount, $commerceCode, $buyOrder)
    {
        $this->sharesAmount = $sharesAmount;
        $this->sharesNumber = $sharesNumber;
        $this->amount = $amount;
        $this->commerceCode = $commerceCode;
        $this->buyOrder = $buyOrder;
    }
}