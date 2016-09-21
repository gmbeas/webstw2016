<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 20-09-2016
 * Time: 9:56
 */


use GuzzleHttp\Client;


function actualizaCarro($a1, $a2, $a3){

}

function creaSesionUsuario($ficha){
    Session::put('cliente', $ficha);
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



function getBusqueda($search){
    $client = new Client;
    $url = Config::get('constants.SERVICIOS.METHOD_BUSQUEDA');
    $r = $client->request('POST', $url, [
        'json' => [
            "Tienda"        =>  "29",
            "PalabraClave"  =>  $search,
            "Rut"           =>  ""
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
            "Rut"        =>  ""
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
            "Rut"     =>  ""
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
            "Rut"       =>  "",
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
            "Rut"       =>  ""
        ]]);
    $pp = $r->getBody();
    $response_body = json_decode($pp, true);
    return $response_body;
}

