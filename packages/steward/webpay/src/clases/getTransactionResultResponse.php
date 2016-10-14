<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 10:09
 */

namespace Steward\Webpay\Clases;


class getTransactionResultResponse
{
    /**
     * @var transactionResultOutput $return
     * @access public
     */
    public $return = null;

    /**
     * @param transactionResultOutput $return
     * @access public
     */
    public function __construct($return)
    {
        $this->return = $return;
    }
}