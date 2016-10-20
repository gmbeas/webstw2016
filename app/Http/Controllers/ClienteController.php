<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use URL;
use Session;
use Alert;
use Steward\Phpcart\Carrito;

class ClienteController extends Controller
{
    public function login(){
        $invitado = false;
        if(Session::has('url.checkout')){
            Session::put('url.intended', Session::get('url.checkout'));
            Session::forget('url.checkout');
            $invitado = true;
        }else{
            Session::put('url.intended', URL::previous());
        }

        if(checkSesionUsuario()){
            return redirect()->action('HomeController@index');
        }
        else{
            return view('pages.ventas.login')->with('invitado', $invitado);
        }
    }

    public function doLogin(){
        $rules = array(
            'rutcliente'    => 'required|min:7',
            'password' => 'required|alphaNum|min:3'
        );

        $mensaje = [
            'rutcliente.min' => 'largo mínimo 10',
            'rutcliente.required' => 'campo requerido',
            'password.required' => 'campo requerido',
            'password.min' => 'largo mínimo 3',
        ];

        $validator = Validator::make(Input::all(), $rules, $mensaje);

        if ($validator->fails()) {
            Alert::error('Ocurrio un error!')->persistent("Cerrar");
            return Redirect::to('login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password'));
        }else{
            $userdata = array(
                'rutcliente'     => Input::get('rutcliente'),
                'password'  => Input::get('password')
            );

            $ficha = getLogin($userdata['rutcliente'], $userdata['password']);
            if($ficha['_error']['Error']){

                Alert::error($ficha['_error']['ErrorMensaje'])->persistent("Cerrar");
                return Redirect::to('login')
                    ->withInput(Input::except('password'));

            }else{
                $ficha['_ficha']['Invitado'] = false;
                creaSesionUsuario($ficha['_ficha']);
                actualizaCarro("0", "0", "0");
                Alert::info('Has iniciado sesión', 'Hola ' . $ficha['_ficha']['MbAuxRaz'])->persistent("Cerrar");

                return Redirect::to(Session::get('url.intended'));
            }
        }
    }

    public function doLogout(){
        eliminaSesionUsuario();
        actualizaCarro("0", "0", "0");
        return Redirect::to('login');
    }

    public function getCiudades(Request $request){
        $idregion = $request->input('idregion');
        $inforegiones = getRegCiuCom(2, $idregion, 0);
        die(json_encode($inforegiones['_regciucom']));
    }

    public function getComunas(Request $request){
        $idregion = $request->input('idregion');
        $idciudad = $request->input('idciudad');

        $inforegiones = getRegCiuCom(3, $idregion, $idciudad);
        die(json_encode($inforegiones['_regciucom']));
    }

    public function addDireccion(Request $request){
        $direccion = $request->input('direccion');
        $idregion = $request->input('idregion');
        $idciudad = $request->input('idciudad');
        $idcomuna = $request->input('idcomuna');

        $nomregion = $request->input('nomregion');
        $nomciudad = $request->input('nomciudad');
        $nomcomuna = $request->input('nomcomuna');

        $nuevadire = setNuevaDireccion($direccion, $idregion, $idciudad, $idcomuna);
        $idnuevadire = $nuevadire['_dire'];

        $xx = getSesionUsuario();
        $nn = array('MbAuxCod' => getRutSession(),
            'MbDirCod' => $idnuevadire['DirCod'],
            'MbDirDes' => $direccion,
            'MbDirReg' => $idregion,
            'MbDirCiu' => $idciudad,
            'MbDirCom' => $idcomuna,
            'MbRegNom' => $nomregion,
            'MbCiuNom' => $nomciudad,
            'MbZonNom' => $nomcomuna);

        array_push($xx['_direcciones'], $nn);

        creaSesionUsuario($xx);

        return response()->json(json_encode($idnuevadire));

    }

    public function validaRegistro(Request $request)
    {
        if ($request->input('rutclientereg') == "") {
            Alert::info('Debe ingresar rut para validar')->persistent("Cerrar");
            return Redirect::to('login');
        } else {
            $rutinput = str_replace(".", "", $request->input('rutclientereg'));

            $dv = substr($rutinput, -1);
            // verificar caracteres
            $len = strlen($rutinput - 1);
            $rut = '';
            for ($x = 0; $x < $len; $x++) {
                if (is_numeric($rutinput[$x])) {
                    $rut .= $rutinput[$x];
                }
            }

            $tt = validaRut($rut, $dv);


            if ($tt['Error'] == false) {
                $xrut = $rut . "-" . $dv;


                return Redirect::to('registro/' . $xrut);
            } else {
                Alert::error('Si no recuerda su contraseña, de click en olvido contraseña y siga las instrucciones', 'El rut ingresado ya existe.')->persistent("Cerrar");
                return Redirect::to('login');
            }
        }

    }

    public function registroUsuario($rut)
    {
        $empresa = false;
        $giros = array();
        $razonsocial = "";
        $xx = identificaRut($rut);
        foreach ($xx['actividades'] as $actividad) {
            if ($actividad['categoria'] == "Primera") {
                $empresa = true;
                $giros[$actividad['codigo']] = $actividad['giro'];
            }
        }

        $regiones = array();
        $inforegiones = getRegCiuCom(1, 0, 0);
        foreach ($inforegiones['_regciucom'] as $region) {
            $regiones[$region['Id']] = $region['Nombre'];
        }

        if ($empresa)
            $razonsocial = $xx['razon_social'];

        return view('pages.ventas.modulo_registro_usuario')->
        with('empresa', $empresa)->
        with('giros', $giros)->
        with('razonsocial', $razonsocial)->
        with('rut', $rut)->
        with('regiones', $regiones);
    }

    public function registroInvitado()
    {
        $regiones = array();
        $inforegiones = getRegCiuCom(1, 0, 0);
        foreach ($inforegiones['_regciucom'] as $region) {
            $regiones[$region['Id']] = $region['Nombre'];
        }
        return view('pages.ventas.modulo_registro_invitado')->with('regiones', $regiones);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function validaInvitado(Request $request)
    {
        $rutinput = str_replace(".", "", $request->input('rut'));

        $dv = substr($rutinput, -1);
        // verificar caracteres
        $len = strlen($rutinput - 1);
        $rut = '';
        for ($x = 0; $x < $len; $x++) {
            if (is_numeric($rutinput[$x])) {
                $rut .= $rutinput[$x];
            }
        }

        $valordespacho = "0";
        $bruto = "0";
        $iva = "0";
        $neto = "0";

        $tt = validaRut($rut, $dv);

        if ($tt['Error'] == false) {
            $data['Error'] = false;
            $cart = new Carrito('ventas');
            $items = array();
            foreach ($cart->getItems() as $item) {
                $items[] = $item->skuid . ',' . $item->cantidad;
            }
            $skus = '|' . join('|', $items);

            $totales = getTotales($skus, $request->input('regid'), $request->input('ciuid'), $request->input('comid'));

            foreach ($totales['_total'] as $total) {
                if ($total['Tipo'] == "C") {
                    $valordespacho = $total['Flete'];
                    $bruto = $total['PrecioBruto'];
                    $iva = $total['Iva'];
                    $neto = $total['PrecioNeto'];
                }
            }
        } else {
            $data['Error'] = true;
        }

        $data['total']['flete'] = (int)$valordespacho;
        $data['total']['bruto'] = (int)$bruto;
        $data['total']['iva'] = (int)$iva;
        $data['total']['neto'] = (int)$neto + (int)$valordespacho;


        return \GuzzleHttp\json_encode($data);
        /*if ($request->input('rutpersona') == "") {
            Alert::info('Debe ingresar rut para validar')->persistent("Cerrar");
            return Redirect::to('/invitado')->withInput(Input::except('regionpersona'));
        } else {
            $rutinput = str_replace(".", "", $request->input('rutpersona'));

            $dv = substr($rutinput, -1);
            // verificar caracteres
            $len = strlen($rutinput - 1);
            $rut = '';
            for ($x = 0; $x < $len; $x++) {
                if (is_numeric($rutinput[$x])) {
                    $rut .= $rutinput[$x];
                }
            }

            $tt = validaRut($rut, $dv);

            if ($tt['Error'] == false) {
                $xrut = $rut . "-" . $dv;

                $ficha = "";
                $ficha['Invitado'] = true;
                $ficha['MbAuxCod'] = $rut;
                $ficha['MbAuxDv'] = $dv;
                $ficha['MbAuxRaz'] = $request->input('nombrepersona') . " " . $request->input('apellidopersona');
                $ficha['MbGirDes'] = "1-PERSONA NATURAL";
                $ficha['_direcciones'][0]['MbCiuNom'] = "";
                $ficha['_direcciones'][0]['MbDirCiud'] = $request->input('ciudadpersona');
                $ficha['_direcciones'][0]['MbDirCod'] = "1";
                $ficha['_direcciones'][0]['MbDirCom'] = $request->input('comunapersona');
                $ficha['_direcciones'][0]['MbDirDes'] = $request->input('direccionpersona');
                $ficha['_direcciones'][0]['MbDirReg'] = $request->input('regionpersona');
                $ficha['_direcciones'][0]['MbRegNom'] = "";
                $ficha['_direcciones'][0]['MbZonNom'] = "";
                $ficha['_usuarioweb']['ApeM'] ="";
                $ficha['_usuarioweb']['ApeP'] = $request->input('apellidopersona');
                $ficha['_usuarioweb']['Dv'] = $dv;
                $ficha['_usuarioweb']['Email'] = $request->input('mailpersona');
                $ficha['_usuarioweb']['Fantasia'] = $request->input('nombrepersona') . " " . $request->input('apellidopersona');
                $ficha['_usuarioweb']['Nombre'] = $request->input('nombrepersona') . " " . $request->input('apellidopersona');
                $ficha['_usuarioweb']['RazonSocial'] = $request->input('nombrepersona') . " " . $request->input('apellidopersona');
                $ficha['_usuarioweb']['Rut'] = $rut;
                $ficha['_usuarioweb']['Telefono'] = $request->input('fonopersona');

                creaSesionUsuario($ficha);
                return Redirect::to('registro/' . $xrut);
            } else {
                Alert::error('Si no recuerda su contraseña, puede recuperarla', 'El rut ingresado ya existe.')->persistent("Cerrar");
                return Redirect::to('invitado')->withInput(Input::except('regionpersona'));
            }
        }*/
    }
}
