<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 10:08
 */

namespace Steward\Webpay\Clases;


class getTransactionResult
{
    /**
     * @var string $tokenInput
     * @access public
     */
    public $tokenInput = null;

    /**
     * @param string $tokenInput
     * @access public
     */
    public function __construct($tokenInput)
    {
        $this->tokenInput = $tokenInput;
    }
}