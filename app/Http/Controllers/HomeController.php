<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Steward\Phpcart\Carrito;

class HomeController extends Controller
{
    public function index(){

        $cart = new Carrito('ventas');

        //$cart->clear();
        $banners = getBannerHome();
        $agrupados = getAgrupados("");
        $marcas = getMarcas();

        return view('pages.ventas.home')
            ->with('banners', $banners)
            ->with('agrupados', $agrupados)
            ->with('marcas', $marcas);
    }
}
