<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 14-10-2016
 * Time: 12:11
 */

namespace App\Http\Webpay;


class WebPayConfig
{
    private $params = array();

    /**
     * Constructor de WebPayConfig
     * */
    function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Retorna parametros de configuración
     * */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Retorna parametro de configuración
     * */
    public function getParam($name)
    {
        return $this->params[$name];
    }

    /**
     * Retorna parametros de configuración (INTEGRACIÓN por defecto)
     * */
    public function getModo()
    {
        $modo = $this->params["MODO"];
        if (!isset($modo) || $modo == "") {
            $modo = "INTEGRACION";
        }
        return $modo;
    }
}