<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriaController extends Controller
{
    /*
     * VENTAS
     */
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
        $productos = getBusqueda(29, $search);
        return view('pages.ventas.buscador')
            ->with('productos', $productos)
            ->with('palabra', $search);
    }



    public function traecategorias(Request $request){
        $input  = $request->all();

        $tipo = 1;
        if($input['prfid'] == "0")
            $tipo = 2;


        $info = getCategorias(29, $input['arbol'], $input['prfid'], $tipo);
        return response()->json(json_encode($info));
    }

    public function traeproductos(Request $request){
        $input  = $request->all();

        $prfid = '';
        if($input['prfid'] != "0")
            $prfid = $input['prfid'];
        $r = getProductos(29, $input['arbol'], $prfid);

        return response()->json(json_encode($r));
    }



    /*
     * ARRIENDO
     */

    public function traecategoriasArriendo(Request $request){
        $input  = $request->all();

        $tipo = 1;
        if($input['prfid'] == "0")
            $tipo = 2;


        $info = getCategorias(30, $input['arbol'], $input['prfid'], $tipo);
        return response()->json(json_encode($info));
    }

    public function traeproductosArriendo(Request $request){
        $input  = $request->all();

        $prfid = '';
        if($input['prfid'] != "0")
            $prfid = $input['prfid'];
        $r = getProductos(30, $input['arbol'], $prfid);

        return response()->json(json_encode($r));
    }

    public function buscadorArriendo(){
        $search = \Request::get('buscar'); //<-- we use global request to get the param of URI
        $productos = getBusqueda(30, $search);
        return view('pages.arriendo.buscador')
            ->with('productos', $productos)
            ->with('palabra', $search);
    }

    public function viewArriendo($arbol, $prfid, $nombre){
        return view('pages.arriendo.categoria')
            ->with('nombre', $nombre);
    }
}
