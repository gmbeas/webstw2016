<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 10:10
 */

namespace Steward\Webpay\Clases;


class wsInitTransactionInput
{
    /**
     * @var wsTransactionType $wSTransactionType
     * @access public
     */
    public $wSTransactionType = null;
    /**
     * @var string $commerceId
     * @access public
     */
    public $commerceId = null;
    /**
     * @var string $buyOrder
     * @access public
     */
    public $buyOrder = null;
    /**
     * @var string $sessionId
     * @access public
     */
    public $sessionId = null;
    /**
     * @var anyURI $returnURL
     * @access public
     */
    public $returnURL = null;
    /**
     * @var anyURI $finalURL
     * @access public
     */
    public $finalURL = null;
    /**
     * @var wsTransactionDetail[] $transactionDetails
     * @access public
     */
    public $transactionDetails = null;
    /**
     * @var wpmDetailInput $wPMDetail
     * @access public
     */
    public $wPMDetail = null;

    /**
     * @param wsTransactionType $wSTransactionType
     * @param string $commerceId
     * @param string $buyOrder
     * @param string $sessionId
     * @param anyURI $returnURL
     * @param anyURI $finalURL
     * @param wsTransactionDetail[] $transactionDetails
     * @param wpmDetailInput $wPMDetail
     * @access public
     */
    public function __construct($wSTransactionType, $commerceId, $buyOrder, $sessionId, $returnURL, $finalURL, $transactionDetails, $wPMDetail)
    {
        $this->wSTransactionType = $wSTransactionType;
        $this->commerceId = $commerceId;
        $this->buyOrder = $buyOrder;
        $this->sessionId = $sessionId;
        $this->returnURL = $returnURL;
        $this->finalURL = $finalURL;
        $this->transactionDetails = $transactionDetails;
        $this->wPMDetail = $wPMDetail;
    }
}