<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class CompraController extends Controller
{
    public function index(){
        if(checkSesionUsuario()){
            $sessioncliente = getSesionUsuario();

            $direcciones = array();
            $direcciones["0"] = "- Seleccione dirección de despacho";
            foreach($sessioncliente['_direcciones'] as $direccion) {
                $direcciones[$direccion['MbDirCod']] = $direccion['MbDirDes'] . ', ' . $direccion['MbCiuNom'] . ', ' . $direccion['MbZonNom'];
            }

            return view('pages.ventas.checkout')
                ->with('cliente', $sessioncliente)
                ->with('direcciones', $direcciones);
        }
        else{
            Session::put('url.checkout', \URL::to('/checkout'));
            return \Redirect::to('/login');
        }
    }
}
