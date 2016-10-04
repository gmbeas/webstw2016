<?php

namespace App\Http\Controllers;

use App\Compra;
use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Steward\Phpcart\Carrito;

class CompraController extends Controller
{
    public function index(){
        if(checkSesionUsuario()){
            $sessioncliente = getSesionUsuario();
            $cart = new Carrito('ventas');
            $direcciones = array();
            $direcciones["0"] = "- Seleccione dirección de despacho";
            foreach($sessioncliente['_direcciones'] as $direccion) {
                $direcciones[$direccion['MbDirCod']] = $direccion['MbDirDes'] . ', ' . $direccion['MbCiuNom'] . ', ' . $direccion['MbZonNom'];
            }

            $regiones = array();
            $inforegiones = getRegCiuCom(1, 0, 0);
            foreach ($inforegiones['_regciucom'] as $region) {
                $regiones[$region['Id']] = $region['Nombre'];
            }

            return view('pages.ventas.checkout')
                ->with('cliente', $sessioncliente)
                ->with('direcciones', $direcciones)
                ->with('productos', $cart->getItems())
                ->with('regiones', $regiones);
        }
        else{
            Session::put('url.checkout', \URL::to('/checkout'));
            return \Redirect::to('/login');
        }
    }

    public function cambiaDespacho(Request $request){
        $despachoId      = $request->input('despachoId');
        $cliente = getSesionUsuario();
        $direcciones = $cliente['_direcciones'];
        $region = "0";
        $ciudad = "0";
        $comuna = "0";

        $nomdire ="";
        $nomcomu = "";
        $nomregi = "";
        foreach ($direcciones as $direccion){
            if($despachoId == $direccion['MbDirCod']){
                $region = $direccion['MbDirReg'];
                $ciudad = $direccion['MbDirCiu'];
                $comuna = $direccion['MbDirCom'];
                $nomdire = $direccion['MbDirDes'];
                $nomcomu = $direccion['MbZonNom'];
                $nomregi = $direccion['MbRegNom'];
            }
        }

        $cart = new Carrito('ventas');
        $aux = $cart->getItems();
        $items = array();
        foreach ($cart->getItems() as $item) {
            $items[] = $item->skuid . ',' . $item->cantidad;
        }
        $skus = '|' . join('|', $items);

        $totales = getTotales($skus, $region, $ciudad, $comuna);

        $data['direccion']['dire'] = $nomdire;
        $data['direccion']['comu'] = $nomcomu;
        $data['direccion']['regi'] = $nomregi;

        $valordespacho ="";
        $bruto ="";
        $iva ="";
        $neto="";

        foreach ($totales['_total'] as $total){
            if($total['Tipo'] == "C"){
                $valordespacho = $total['Flete'];
                $bruto = $total['PrecioBruto'];
                $iva = $total['Iva'];
                $neto = $total['PrecioNeto'];
            }
        }

        $data['total']['flete'] = (int)$valordespacho;
        $data['total']['bruto'] = (int)$bruto;
        $data['total']['iva'] = (int)$iva;
        $data['total']['neto'] = (int)$neto + (int)$valordespacho;

        die (json_encode($data));
    }

    public function pago(Request $request)
    {
        $aa = $request->all();
        $compra = new Compra();
        $compra->orden = 0;
        $compra->clienteId = getIdUserSession();
        $compra->despachoId = $aa['CompraDespachoId'];
        $compra->subtotal = 0;
        $compra->neto = 0;
        $compra->iva = 0;
        $compra->total = 0;
        $compra->despacho = 0;
        $compra->estado = 1;
        $compra->ip = $request->ip();
        $compra->tipo = 1;

        $compra->save();
    }



    public function indexArriendo(){
        if(checkSesionUsuario()){
            $sessioncliente = getSesionUsuario();
            $cart = new Carrito('arriendo');
            $direcciones = array();
            $direcciones["0"] = "- Seleccione dirección de despacho";
            foreach($sessioncliente['_direcciones'] as $direccion) {
                $direcciones[$direccion['MbDirCod']] = $direccion['MbDirDes'] . ', ' . $direccion['MbCiuNom'] . ', ' . $direccion['MbZonNom'];
            }

            $regiones = array();
            $inforegiones = getRegCiuCom(1, 0, 0);
            foreach ($inforegiones['_regciucom'] as $region) {
                $regiones[$region['Id']] = $region['Nombre'];
            }

            return view('pages.arriendo.checkout')
                ->with('cliente', $sessioncliente)
                ->with('direcciones', $direcciones)
                ->with('productos', $cart->getItems())
                ->with('regiones', $regiones);
        }
        else{
            Session::put('url.checkout', \URL::to('/arriendo/checkout'));
            return \Redirect::to('/login');
        }
    }
}
