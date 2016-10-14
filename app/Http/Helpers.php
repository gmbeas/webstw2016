<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 20-09-2016
 * Time: 9:56
 */


use GuzzleHttp\Client;
use Illuminate\Support\Str;

function validaRut($rut, $dv)
{
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_VALIDA_RUT');
    $r = $client->request('POST', $url, [
        'json' => [
            "Rut" => $rut,
            "Dv" => $dv
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getLanding($tienda, $codigo)
{
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_GET_LANDING');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda" => $tienda,
            "Rut" => getRutSession(),
            "Codigo" => $codigo
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getTest()
{
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_TEST');
    $r = $client->request('POST', $url, [
        'json' => [
            "Id" => 666,
            "Nombre" => "Felipe",
            "Cargo" => "Goma de Marketing",
            "Fono1" => "(+562) 2 7566013",
            "Fono2" => "(+569) 5 6194730"
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}


function getSimulaComboArriendo($comboid, $modid, $ninvitados)
{
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_SIMULA_COMBO_ARRIENDO');
    $r = $client->request('POST', $url, [
        'json' => [
            "CboId" => $comboid,
            "ModId" => $modid,
            "NroInvitados" => $ninvitados
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}


function getTotalComboArriendo($comboid, $modid, $ninvitados)
{
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_TOTAl_COMBO_ARRIENDO');
    $r = $client->request('POST', $url, [
        'json' => [
            "ComboId" => $comboid,
            "ModuloId" => $modid,
            "Invitados" => $ninvitados
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}


function listaCombosArriendo(){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_LISTA_COMBOS_ARRIENDO');
    $r = $client->request('POST', $url);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

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

function generaHtmlArriendo($tienda){
    $cart = new \Steward\Phpcart\Carrito($tienda);
    $htmlcart = '<a href="#" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown"><span class="compact-hidden">Carro de arriendo - <strong>$ ' . number_format($cart->getTotal(), 0, ",", ".") . '</strong></span> <span aria-hidden="true" class="glyphicon glyphicon-shopping-cart"><span class="label-cart">' . $cart->count() . '</span></span></a><div class="dropdown-menu pull-right shoppingcart-box" role="menu"> Su carro de arriendo<ul class="list">';
    foreach($cart->getItems() as $producto){
        $htmlcart .= ' <li class="item"><a href="' . URL::to('/arriendo/ficha/' . $producto->id . '/' . Str::slug($producto->nombre, '-')) . '.html" class="preview-image"> <img class="preview" src="' .URL::asset('/imagenweb/sku/' . $producto->foto) . '" alt=""> </a> <div class="description"> <a href="' .URL::to('/arriendo/ficha/' . $producto->id . '/' . Str::slug($producto->nombre, '-')) .'.html">'. $producto->nombre . '</a> <strong class="price">'.$producto->cantidad .' x $ ' . number_format($producto->precio, 0, ",", ".") .'</strong> </div> </li>';
    }
    $htmlcart .= '</ul> <div class="total">Total: <strong>$' . number_format($cart->getTotal(), 0, ",", ".") .'</strong></div><a href="' . URL::to('/arriendo/checkout') . '" class="btn btn-mega">Confirmar</a><div class="view-link"><a href="' . URL::to('/arriendo/carrito') .'">Ver el Cotización </a></div>';

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


function getStock($tienda, $sku, $cantidad){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_GET_STOCK');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"    =>  $tienda,
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

function setNotaVenta($skus, $regionid, $ciudadid)
{
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_GET_NOTA_VENTA');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda" => "29",
            "Rut" => getRutSession(),
            "ListaPrecio" => getListaPrecioSession(),
            "SkusValidos" => $skus,
            "RegionId" => $regionid,
            "CiudadId" => $ciudadid
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
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

function getListaPrecioSession()
{
    if (checkSesionUsuario()) {
        $cliente = getSesionUsuario();
        return $cliente['Lista'];
    } else {
        return "";
    }
}

function getIdUserSession()
{
    if (checkSesionUsuario()) {
        $cliente = getSesionUsuario();
        return $cliente['_usuarioweb']['Id'];
    } else {
        return "0";
    }
}


function getBusqueda($tienda, $search){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_BUSQUEDA');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"        =>  $tienda,
            "PalabraClave"  =>  $search,
            "Rut"           =>  getRutSession()
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}


function getCategorias($tienda, $arbol, $prfid, $tipo){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_GET_CATEGORIA');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"     =>  $tienda,
            "Arbol"      =>  $arbol,
            "PrfId"      => $prfid,
            "Tipo"       => $tipo
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}



function getProductos($tienda, $arbol, $prfid){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_GET_PRODUCTOS');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"     =>  $tienda,
            "Arbol"      =>  $arbol,
            "PrfId"      =>  $prfid,
            "Rut"        =>  getRutSession()
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getFichaProducto($tienda, $sku){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_GET_FICHA');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"    =>  $tienda,
            "Sku"       =>  $sku,
            "Rut"     =>  getRutSession()
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getMenuSuperior($tienda){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_MENU_SUPERIOR');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda" => $tienda
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getBannerHome($tienda){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_BANNER_HOME');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda" => $tienda
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getAgrupados($tienda, $PrfId){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_AGRUPADOS');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"    =>  $tienda,
            "Rut"       =>  getRutSession(),
            "PrfId"     =>  $PrfId
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getMarcas($tienda){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_GET_MARCAS');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"    =>  $tienda
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

function getMasVendidos($tienda){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_MAS_VENDIDOS');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"    =>  $tienda,
            "Rut"       =>  getRutSession()
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

