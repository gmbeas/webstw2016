<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 12:09
 */

namespace App\Http\Webpay\Clases;


class wsInitTransactionOutput
{
    /**
     * @var string $token
     * @access public
     */
    public $token = null;
    /**
     * @var string $url
     * @access public
     */
    public $url = null;

    /**
     * @param string $token
     * @param string $url
     * @access public
     */
    public function __construct($token, $url)
    {
        $this->token = $token;
        $this->url = $url;
    }
}