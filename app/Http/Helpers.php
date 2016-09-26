<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 20-09-2016
 * Time: 9:56
 */


use GuzzleHttp\Client;
use Illuminate\Support\Str;


function getRegCiuCom($tipo, $regionid, $ciudadid){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_GET_REGCIUCOM');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tipo"      =>  $tipo,
            "RegionId"  =>  $regionid,
            "CiudadId"  => $ciudadid
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}



function generaHtml($tienda){
    $cart = new \Steward\Phpcart\Carrito($tienda);
    $htmlcart = '<a href="#" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown"><span class="compact-hidden">Carro de compras - <strong>$ ' . number_format($cart->getTotal(), 0, ",", ".") . '</strong></span> <span aria-hidden="true" class="glyphicon glyphicon-shopping-cart"><span class="label-cart">' . $cart->count() . '</span></span></a><div class="dropdown-menu pull-right shoppingcart-box" role="menu"> Su carro de compras<ul class="list">';
    foreach($cart->getItems() as $producto){
        $htmlcart .= ' <li class="item"><a href="' . URL::to('/ficha/' . $producto->id . '/' . Str::slug($producto->nombre, '-')) . '.html" class="preview-image"> <img class="preview" src="' .URL::asset('/imagenweb/sku/' . $producto->foto) . '" alt=""> </a> <div class="description"> <a href="' .URL::to('/ficha/' . $producto->id . '/' . Str::slug($producto->nombre, '-')) .'.html">'. $producto->nombre . '</a> <strong class="price">'.$producto->cantidad .' x $ ' . number_format($producto->precio, 0, ",", ".") .'</strong> </div> </li>';
    }
    $htmlcart .= '</ul> <div class="total">Total: <strong>$' . number_format($cart->getTotal(), 0, ",", ".") .'</strong></div><a href="' . URL::to('/checkout') . '" class="btn btn-mega">Pagar</a><div class="view-link"><a href="' . URL::to('/carrito') .'">Ver el Carro </a></div>';

    return $htmlcart;
}


function setNuevaDireccion($direccion, $regionid, $ciudadid, $comunaid){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_NUEVA_DIRECCION');
    $r = $client->request('POST', $url, [
        'json' => [
            "Rut"       =>  getRutSession(),
            "Direccion" =>  $direccion,
            "RegionId"  =>  $regionid,
            "CiudadId"  =>  $ciudadid,
            "ComunaId"  =>  $comunaid
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}


function getStock($sku, $cantidad){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_GET_STOCK');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"    =>  '29',
            "Sku"       =>  $sku,
            "Cantidad"  => $cantidad
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}


function actualizaCarro($region, $ciudad, $comuna){
    $cart = new \Steward\Phpcart\Carrito('ventas');
    $items = array();
    foreach ($cart->getItems() as $item) {
        $items[] = $item->skuid . ',' . $item->cantidad;
    }
    $skus = '|' . join('|', $items);

    $totales = getTotales($skus, $region, $ciudad, $comuna);
    $kk = $totales;
    foreach ($totales['_total'] as $producto){
        if($producto['Tipo'] == 'D'){
            $cart->updatePrecio($producto['Sku'], $producto['PrecioUnidadBruto']);
        }
    }
}

function creaSesionUsuario($ficha){
    Session::put('cliente', $ficha);
}

function getTotales($skus, $region, $ciudad, $comuna){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_GET_TOTALES');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"    =>  "29",
            "Rut"       =>  getRutSession(),
            "Skus"      =>  $skus,
            "CodPromo"  =>  "",
            "RegionId"  =>  $region,
            "CiudadId"  =>  $ciudad,
            "ComundaId" =>  $comuna
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getLogin($rut, $password){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_LOGIN');
    $r = $client->request('POST', $url, [
        'json' => [
            "Rut"       =>  $rut,
            "Password"  =>  $password
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function checkSesionUsuario(){
    if(Session::has('cliente'))
        return true;
    else
        return false;
}

function eliminaSesionUsuario(){
    Session::forget('cliente');
}

function getSesionUsuario(){
    return Session::get('cliente');
}


function getRutSession(){
    if(checkSesionUsuario()){
        $cliente = getSesionUsuario();
        return $cliente['MbAuxCod'];
    }else{
        return "";
    }
}


function getBusqueda($search){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_BUSQUEDA');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"        =>  "29",
            "PalabraClave"  =>  $search,
            "Rut"           =>  getRutSession()
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}


function getCategorias($arbol, $prfid, $tipo){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_GET_CATEGORIA');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"     =>  "29",
            "Arbol"      =>  $arbol,
            "PrfId"      => $prfid,
            "Tipo"       => $tipo
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}



function getProductos($arbol, $prfid){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_GET_PRODUCTOS');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"     =>  "29",
            "Arbol"      =>  $arbol,
            "PrfId"      =>  $prfid,
            "Rut"        =>  getRutSession()
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getFichaProducto($sku){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_GET_FICHA');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"    =>  "29",
            "Sku"       =>  $sku,
            "Rut"     =>  getRutSession()
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getMenuSuperior(){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_MENU_SUPERIOR');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda" => "29"
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getBannerHome(){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_BANNER_HOME');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda" => "29"
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getAgrupados($PrfId){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_AGRUPADOS');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"    =>  "29",
            "Rut"       =>  getRutSession(),
            "PrfId"     =>  $PrfId
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getMarcas(){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_GET_MARCAS');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"    =>  "29"
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getMasVendidos(){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_MAS_VENDIDOS');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"    =>  "29",
            "Rut"       =>  getRutSession()
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

