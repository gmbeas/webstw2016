<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 10:09
 */

namespace Steward\Webpay\Clases;


class initTransactionResponse
{
    /**
     * @var wsInitTransactionOutput $return
     * @access public
     */
    public $return = null;

    /**
     * @param wsInitTransactionOutput $return
     * @access public
     */
    public function __construct($return)
    {
        $this->return = $return;
    }
}