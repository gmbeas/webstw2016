<?php

/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 10:06
 */
namespace Steward\Webpay\Clases;

class acknowledgeTransaction
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