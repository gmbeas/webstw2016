<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 12:10
 */

namespace App\Http\Webpay\Clases;


class wsTransactionDetailOutput extends wsTransactionDetail
{
    /**
     * @var string $authorizationCode
     * @access public
     */
    public $authorizationCode = null;
    /**
     * @var string $paymentTypeCode
     * @access public
     */
    public $paymentTypeCode = null;
    /**
     * @var int $responseCode
     * @access public
     */
    public $responseCode = null;

    /**
     * @param float $sharesAmount
     * @param int $sharesNumber
     * @param float $amount
     * @param string $commerceCode
     * @param string $buyOrder
     * @param string $authorizationCode
     * @param string $paymentTypeCode
     * @param int $responseCode
     * @access public
     */
    public function __construct($sharesAmount, $sharesNumber, $amount, $commerceCode, $buyOrder, $authorizationCode, $paymentTypeCode, $responseCode)
    {
        parent::__construct($sharesAmount, $sharesNumber, $amount, $commerceCode, $buyOrder);
        $this->authorizationCode = $authorizationCode;
        $this->paymentTypeCode = $paymentTypeCode;
        $this->responseCode = $responseCode;
    }
}