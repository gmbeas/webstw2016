<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 12:08
 */

namespace App\Http\Webpay\Clases;


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