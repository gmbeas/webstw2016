<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 10:23
 */

namespace Steward\Webpay;


class Webpay
{
    var $config, $webpayNormal;

    /**
     * Constuctor
     * */
    public function __construct($params)
    {

        $this->config = new WebPayConfig($params);
    }

    public function getNormalTransaction()
    {
        if ($this->webpayNormal == null) {
            $this->webpayNormal = new WebPayNormal($this->config);
        }
        return $this->webpayNormal;
    }

    /**
     * Envia por método POST el token
     * */
    public function redirect($url, $data)
    {
        echo "<form action='" . $url . "' method='POST' name='webpayForm'>";
        foreach ($data as $name => $value) {
            echo "<input type='hidden' name='" . htmlentities($name) . "' value='" . htmlentities($value) . "'>";
        }
        echo "</form>"
            . "<script language='JavaScript'>"
            . "document.webpayForm.submit();"
            . "</script>";
    }
}