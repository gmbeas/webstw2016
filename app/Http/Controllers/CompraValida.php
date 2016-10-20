<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 17-10-2016
 * Time: 13:20
 */

namespace App\Http\Controllers;

use App\Compra;
use App\Http\Webpay\WebPaySOAP;
use App\Pago;

class CompraValida
{

    public static function guardaPago($result)
    {
        $pago = new Pago();
        $pago->compraid = "1";
        $pago->orden = $result->buyOrder;
        $pago->monto = "1";
        $pago->numerotarjeta = "";
        $pago->fechahora = "";
        $pago->tipotarjeta = "";
        $pago->mac = "";
        $pago->codigoautorizacion = "";
        $pago->cuotas = 0;
        $pago->fechaexpiracion = "";
        $pago->fechacontable = "";
        $pago->codigo = "";
        $pago->respuesta = "";
        $pago->estado = "1";
        $pago->save();
    }

    public static function actualizaEstadoCompra($nv, $monto)
    {
        $compra = Compra::where('orden', '=', $nv)->get();

        $xx = $compra->count();
        if ($xx > 0) {
            if ($compra[0]->total = $monto) {
                $compra[0]->estado = 2;
                $compra[0]->save();
                return true;
            } else
                return false;
        }
        return false;
    }

    public static function getCabecera($nv)
    {
        $compra = Compra::where('orden', '=', $nv)->get();
        return $compra[0];
    }

    public static function getDetalle($id)
    {
        return Compra::find($id);
    }
}