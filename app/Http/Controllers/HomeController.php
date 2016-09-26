<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Steward\Phpcart\Carrito;

class HomeController extends Controller
{
    public function index(){

        $cart = new Carrito('ventas');

        //$cart->clear();
        $banners = getBannerHome(29);
        $agrupados = getAgrupados(29, "");
        $marcas = getMarcas(29);

        return view('pages.ventas.home')
            ->with('banners', $banners)
            ->with('agrupados', $agrupados)
            ->with('marcas', $marcas);
    }


    public function indexArriendo(){
        $banners = getBannerHome(30);
        $agrupados = getAgrupados(30, "");
        $marcas = getMarcas(30);

        return view('pages.arriendo.home')
            ->with('banners', $banners)
            ->with('agrupados', $agrupados)
            ->with('marcas', $marcas);
    }
}
