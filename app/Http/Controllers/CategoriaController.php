<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriaController extends Controller
{
    //
    public function view($arbol, $prfid, $nombre){
        $r = getProductos($arbol, $prfid);


        return view('pages.ventas.categoria')
            ->with('productos', $r)
            ->with('nombre', $nombre);
    }

    public function buscador(){
        $search = \Request::get('buscar'); //<-- we use global request to get the param of URI
        $productos = getBusqueda($search);
        return view('pages.ventas.buscador')
            ->with('productos', $productos)
            ->with('palabra', $search);
    }
}
