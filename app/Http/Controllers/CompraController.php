<?php

namespace App\Http\Controllers;

use App\Compra;
use App\CompraDetalle;
use App\Http\Certificados;
use App\Http\Webpay\WebPaySOAP;
use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Steward\Phpcart\Carrito;

use Alert;


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

        $data['direccion']['ciuid'] = $ciudad;
        $data['direccion']['regiid'] = $region;



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

        $cart = new Carrito('ventas');
        $jjj = $cart->getTotal();
        $hhh = $cart->getBruto($aa['valordespachoinput']);


        $items = array();
        foreach ($cart->getItems() as $item) {
            $items[] = $item->id . ',' . $item->cantidad . ',' . $item->unidad . ',' . $item->precio;
        }
        $skus = '|' . join('|', $items);


        $nv = setNotaVenta($skus, $aa['valoridregion'], $aa['valoridciudad']);

        $compra = new Compra();
        $compra->orden = $nv['NotaVenta'];
        $compra->clienteId = getIdUserSession();
        $compra->despachoId = $aa['CompraDespachoId'];
        $compra->subtotal = 0;
        $compra->neto = $hhh['neto'];
        $compra->iva = $hhh['iva'];
        $compra->total = $hhh['bruto'];
        $compra->despacho = $aa['valordespachoinput'];
        $compra->estado = 1;
        $compra->ip = $request->ip();
        $compra->tipo = 1;

        $compra->save();
        $ultimoid = $compra->id;


        foreach ($cart->getItems() as $item) {
            $detalle = new CompraDetalle();
            $detalle->sku = $item->id;
            $detalle->compraid = $ultimoid;
            $detalle->cantidad = $item->cantidad;
            $detalle->precio = $item->precio;
            $detalle->um = $item->unidad;
            $detalle->save();
        }

        $certificate = Certificados::getCertificados();

        $webpay_settings = array(
            "MODO" => "INTEGRACION",
            "PRIVATE_KEY" => $certificate['private_key'],
            "PUBLIC_CERT" => $certificate['public_cert'],
            "WEBPAY_CERT" => $certificate['webpay_cert'],
            "COMMERCE_CODE" => $certificate['commerce_code'],
            "URL_RETURN" => "http://localhost:8080/webstw/public/respuesta",
            "URL_FINAL" => "http://localhost:8080/webstw/public/finaliza",
        );


        $webpay = new WebPaySOAP($webpay_settings);
        $webpay = $webpay->getNormalTransaction();

        $request = array(
            "amount" => $hhh['bruto'],      // monto a cobrar
            "buyOrder" => $nv['NotaVenta'],    // numero orden de compra
            "sessionId" => uniqid(), // idsession local
        );

        $result = $webpay->initTransaction($request["amount"], $request["sessionId"], $request["buyOrder"]);
        //Alert::info('Email was sent!');
        //return back();
        return view('webpay.pago')->with('url', $result['url'])->with('token_ws', $result['token_ws']);
    }

    public function respuesta(Request $request)
    {
        $certificate = Certificados::getCertificados();
        $request = array(
            "token" => $request->input("token_ws")
        );

        $webpay_settings = array(
            "MODO" => "INTEGRACION",
            "PRIVATE_KEY" => $certificate['private_key'],
            "PUBLIC_CERT" => $certificate['public_cert'],
            "WEBPAY_CERT" => $certificate['webpay_cert'],
            "COMMERCE_CODE" => $certificate['commerce_code'],
            "URL_RETURN" => "http://localhost:8080/webstw/public/respuesta",
            "URL_FINAL" => "http://localhost:8080/webstw/public/finaliza",
        );


        $webpay = new WebPaySOAP($webpay_settings);
        $webpay = $webpay->getNormalTransaction();
        $result = $webpay->getTransactionResult($request["token"]);

        if ($result->detailOutput->responseCode === 0) {
            return view('webpay.pago')->with('url', $result->urlRedirection)->with('token_ws', $request["token"]);
        } else {
            Alert::error('Pago RECHAZADO por webpay!')->persistent("Cerrar");
            return redirect('checkout');
        }
    }

    public function finaliza(Request $request)
    {
        $pp = $request->all();
        if (isset($pp['token_ws']) && ($pp['token_ws'] != null)) { //VENTA OK
            return view('webpay.exito');
        } else { //ANULA
            Alert::error('Transacción Anulada!')->persistent("Cerrar");
            return redirect('checkout');
        }
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
