<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 10:08
 */

namespace Steward\Webpay\Clases;


class cardDetail
{
    /**
     * @var string $cardNumber
     * @access public
     */
    public $cardNumber = null;
    /**
     * @var string $cardExpirationDate
     * @access public
     */
    public $cardExpirationDate = null;

    /**
     * @param string $cardNumber
     * @param string $cardExpirationDate
     * @access public
     */
    public function __construct($cardNumber, $cardExpirationDate)
    {
        $this->cardNumber = $cardNumber;
        $this->cardExpirationDate = $cardExpirationDate;
    }
}