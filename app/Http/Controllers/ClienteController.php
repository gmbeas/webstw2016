<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use URL;
use Session;

class ClienteController extends Controller
{
    public function login(){
        Session::put('url.intended', URL::previous());
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
                return Redirect::to('login')
                    ->withInput(Input::except('password'));

            }else{
                creaSesionUsuario($ficha['_ficha']);
                actualizaCarro("0", "0", "0");

                return Redirect::to(Session::get('url.intended'));
            }
        }
    }

    public function doLogout(){
        eliminaSesionUsuario();
        actualizaCarro("0", "0", "0");
        return Redirect::to('login');
    }
}