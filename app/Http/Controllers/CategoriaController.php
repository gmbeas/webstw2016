<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriaController extends Controller
{
    //
    public function view($arbol, $prfid, $nombre){
        /*$tipo = 1;
        if($prfid == "0")
            $tipo = 2;


        $info = getCategorias($arbol, $prfid, $tipo);


        $r = "0";
        if($tipo == 1){
            $r = getProductos($arbol, "");
        }*/


        //$r = getProductos("49807,49824,49941", "");




        return view('pages.ventas.categoria')
            ->with('nombre', $nombre);
    }

    public function buscador(){
        $search = \Request::get('buscar'); //<-- we use global request to get the param of URI
        $productos = getBusqueda($search);
        return view('pages.ventas.buscador')
            ->with('productos', $productos)
            ->with('palabra', $search);
    }

    public function traecategorias(Request $request){
        $input  = $request->all();

        $tipo = 1;
        if($input['prfid'] == "0")
            $tipo = 2;


        $info = getCategorias($input['arbol'], $input['prfid'], $tipo);
        return response()->json(json_encode($info));
    }

    public function traeproductos(Request $request){
        $input  = $request->all();

        $prfid = '';
        if($input['prfid'] != "0")
            $prfid = $input['prfid'];
        $r = getProductos($input['arbol'], $prfid);

        return response()->json(json_encode($r));
    }
}
