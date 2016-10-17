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

class ClienteController extends Controller
{
    public function login(){

        if(Session::has('url.checkout')){
            Session::put('url.intended', Session::get('url.checkout'));
            Session::forget('url.checkout');
        }else{
            Session::put('url.intended', URL::previous());
        }

        if(checkSesionUsuario()){
            return redirect()->action('HomeController@index');
        }
        else{
            return view('pages.ventas.login');
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
        if ($request->input('rutcliente') == "") {
            Alert::info('Debe ingresar rut para validar')->persistent("Cerrar");
            return Redirect::to('login');
        } else {
            $rutinput = str_replace(".", "", $request->input('rutcliente'));

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
        $giro = "";
        $codigo = "";
        $razonsocial = "";
        $xx = identificaRut($rut);
        foreach ($xx['actividades'] as $actividad) {
            if ($actividad['categoria'] == "Primera") {
                $empresa = true;
                $giro = $actividad['giro'];
                $codigo = $actividad['codigo'];
            }
        }
        if ($empresa)
            $razonsocial = $xx['razon_social'];

        return view('pages.ventas.modulo_registro_usuario')->with('empresa', $empresa)->with('giro', $giro)->with('codigo', $codigo)->with('razonsocial', $razonsocial)->with('rut', $rut);
    }
}
