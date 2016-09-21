<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use URL;
use GuzzleHttp\Client;


use App\Http\Requests;

class HomeController extends Controller
{
    //


    public function index(){

        $banners = getBannerHome();
        $agrupados = getAgrupados("");
        $marcas = getMarcas();

        return view('pages.ventas.home')
            ->with('banners', $banners)
            ->with('agrupados', $agrupados)
            ->with('marcas', $marcas);
    }
}
