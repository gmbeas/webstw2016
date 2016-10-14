<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 10:10
 */

namespace Steward\Webpay\Clases;


class transactionResultOutput
{
    /**
     * @var string $accountingDate
     * @access public
     */
    public $accountingDate = null;
    /**
     * @var string $buyOrder
     * @access public
     */
    public $buyOrder = null;
    /**
     * @var cardDetail $cardDetail
     * @access public
     */
    public $cardDetail = null;
    /**
     * @var wsTransactionDetailOutput[] $detailOutput
     * @access public
     */
    public $detailOutput = null;
    /**
     * @var string $sessionId
     * @access public
     */
    public $sessionId = null;
    /**
     * @var dateTime $transactionDate
     * @access public
     */
    public $transactionDate = null;
    /**
     * @var string $urlRedirection
     * @access public
     */
    public $urlRedirection = null;
    /**
     * @var string $VCI
     * @access public
     */
    public $VCI = null;

    /**
     * @param string $accountingDate
     * @param string $buyOrder
     * @param cardDetail $cardDetail
     * @param string $sessionId
     * @param dateTime $transactionDate
     * @param string $urlRedirection
     * @param string $VCI
     * @access public
     */
    public function __construct($accountingDate, $buyOrder, $cardDetail, $sessionId, $transactionDate, $urlRedirection, $VCI)
    {
        $this->accountingDate = $accountingDate;
        $this->buyOrder = $buyOrder;
        $this->cardDetail = $cardDetail;
        $this->sessionId = $sessionId;
        $this->transactionDate = $transactionDate;
        $this->urlRedirection = $urlRedirection;
        $this->VCI = $VCI;
    }
}