<?php
/**
 * Created by PhpStorm.
 * User: Gonzalo Martinez
 * Date: 20-09-2016
 * Time: 11:11
 */


$url = "http://localhost:35462/";
//$url = "http://192.168.1.230/apilaravel/";
$api = "api/";

$METHOD_MENU_SUPERIOR = "GetMenuCompletoSuperior";
$METHOD_BANNER_HOME = "GetBannerHome";
$METHOD_DESTACADOS = "GetDestacados";
$METHOD_AGRUPADOS = "GetAgrupados";
$METHOD_MAS_VENDIDOS = "GetMasVendidosHome";
$METHOD_GET_MARCAS = "GetMarcas";
$METHOD_BUSQUEDA = "GetBusqueda";
$METHOD_LOGIN = "Login";
$METHOD_GET_FICHA = "GetProductoFicha";
$METHOD_GET_PRODUCTOS = "GetProductos";
$METHOD_GET_STOCK = "Stock";
$METHOD_GET_TOTALES = "GetTotales";
$METHOD_GET_REGCIUCOM = "GetRegCiuCom";
$METHOD_NUEVA_DIRECCION = "NuevaDireccion";
$METHOD_GET_CATEGORIA = "GetCategoria";
$METHOD_LISTA_COMBOS_ARRIENDO	= "ListaCombos";
$METHOD_TOTAl_COMBO_ARRIENDO = "GetTotalArriendo";
$METHOD_SIMULA_COMBO_ARRIENDO = "GetSimulaComboArriendo";
$METHOD_GET_NOTA_VENTA = "GeneraVentaNota";
$METHOD_GET_LANDING = "GetLanding";
$METHOD_VALIDA_RUT = "ValidaRut";

$METHOD_TEST = "GeneraFirma";

return [
    'SERVICIOS' => [
        'METHOD_MENU_SUPERIOR' => $url . $api . $METHOD_MENU_SUPERIOR,
        'METHOD_BANNER_HOME' => $url . $api . $METHOD_BANNER_HOME,
        'METHOD_DESTACADOS' => $url . $api . $METHOD_DESTACADOS,
        'METHOD_AGRUPADOS' => $url . $api . $METHOD_AGRUPADOS,
        'METHOD_MAS_VENDIDOS' => $url . $api . $METHOD_MAS_VENDIDOS,
        'METHOD_GET_MARCAS' => $url . $api . $METHOD_GET_MARCAS,
        'METHOD_BUSQUEDA' => $url . $api . $METHOD_BUSQUEDA,
        'METHOD_LOGIN' => $url . $api . $METHOD_LOGIN,
        'METHOD_GET_FICHA' => $url . $api . $METHOD_GET_FICHA,
        'METHOD_GET_PRODUCTOS' => $url . $api . $METHOD_GET_PRODUCTOS,
        'METHOD_GET_STOCK' => $url . $api . $METHOD_GET_STOCK,
        'METHOD_GET_TOTALES' => $url . $api . $METHOD_GET_TOTALES,
        'METHOD_GET_REGCIUCOM' => $url . $api . $METHOD_GET_REGCIUCOM,
        'METHOD_NUEVA_DIRECCION' => $url . $api . $METHOD_NUEVA_DIRECCION,
        'METHOD_GET_CATEGORIA' => $url . $api . $METHOD_GET_CATEGORIA,
        'METHOD_LISTA_COMBOS_ARRIENDO' => $url . $api . $METHOD_LISTA_COMBOS_ARRIENDO,
        'METHOD_TOTAl_COMBO_ARRIENDO' => $url . $api . $METHOD_TOTAl_COMBO_ARRIENDO,
        'METHOD_SIMULA_COMBO_ARRIENDO' => $url . $api . $METHOD_SIMULA_COMBO_ARRIENDO,
        'METHOD_GET_NOTA_VENTA' => $url . $api . $METHOD_GET_NOTA_VENTA,
        'METHOD_GET_LANDING' => $url . $api . $METHOD_GET_LANDING,
        'METHOD_VALIDA_RUT' => $url . $api . $METHOD_VALIDA_RUT,
        'METHOD_TEST' => $url . $api . $METHOD_TEST,
    ]
];