@extends('layouts.ventas.default')

@section('titulo', 'Registro')

@section('content')
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <section class="container">
        <nav class="breadcrumbs"><a href="#">Home</a> <span class="divider">›</span> Acceso a tu cuenta</nav>
    </section>

    <style>
        #registroRegistroeForm .error {
            border-color: #c00232;
        }
    </style>

    @if($empresa == true)
        <section class="container">
            <div class="row">
                <section class="col-sm-6 col-md-6 col-lg-6">
                    <section class="container-with-large-icon login-form">
                        <div class="large-icon"></div>
                        <div class="wrap">
                            <h3>Información empresa</h3>
                            <div class="form-group">
                                <label for="text">Rut Empresa:</label>
                                {{ Form::input('text', 'rutempresa', $rut, ['class' => 'form-control', 'id' => 'rutempresa']) }}
                            </div>
                            <div class="form-group">
                                <label for="text">Nombre o Razón Social:</label>
                                {{ Form::input('text', 'razonsocial', $razonsocial, ['class' => 'form-control', 'id' => 'razonsocial']) }}
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3">Giro:</label>

                            </div>


                            <div class="form-group">
                                <label for="password">Dirección</label>
                                {{ Form::input('text', 'direccionempresa', null, ['class' => 'form-control', 'id' => 'direccionempresa']) }}
                            </div>

                            <div class="form-group">
                                <label for="password">Región</label>

                            </div>

                            <div class="form-group">
                                <label for="password">Ciudad</label>

                            </div>

                            <div class="form-group">
                                <label for="password">Comuna</label>

                            </div>

                        </div>
                    </section>
                </section>
                <section class="col-sm-6 col-md-6 col-lg-6">
                    <section class="container-with-large-icon login-form">
                        <div class="large-icon"><img src="" alt=""></div>
                        <div class="wrap">
                            <h3>Información de contacto</h3>
                            <div class="form-group">
                                <label for="password">Nombre:</label>
                                {{ Form::input('text', 'nombreempresa', null, ['class' => 'form-control', 'id' => 'nombreempresa']) }}
                            </div>
                            <div class="form-group">
                                <label for="password">Apellido:</label>
                                {{ Form::input('text', 'apellidoempresa', null, ['class' => 'form-control', 'id' => 'apellidoempresa']) }}
                            </div>
                            <div class="form-group">
                                <label for="password">Rut:</label>
                                {{ Form::input('text', 'rutcontactoempresa', null, ['class' => 'form-control', 'id' => 'rutcontactoempresa']) }}
                            </div>
                            <div class="form-group">
                                <label for="password">E-mail:</label>
                                {{ Form::input('email', 'mailempresa', null, ['class' => 'form-control', 'id' => 'mailempresa']) }}
                            </div>

                            <div class="form-group">
                                <label for="password">Repetir E-mail</label>
                                {{ Form::input('email', 'mailempresa2', null, ['class' => 'form-control', 'id' => 'mailempresa']) }}
                            </div>

                            <div class="form-group">
                                <label for="password">Telefono:</label>
                                {{ Form::input('text', 'fonoempresa', null, ['class' => 'form-control', 'id' => 'fonoempresa']) }}
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                {{ Form::input('password', 'passwordempresa', null, ['class' => 'form-control', 'id' => 'passwordempresa']) }}
                            </div>
                            <button type="submit" id="registro" class="btn btn-mega">Registrarse</button>
                        </div>
                    </section>
                </section>
            </div>
        </section>
    @else
        <section class="container">
            <div class="row">
                <section class="col-sm-6 col-md-6 col-lg-6">
                    <section class="container-with-large-icon login-form">
                        <div class="large-icon"></div>
                        <div class="wrap">
                            <h3>CREAR UNA CUENTA</h3>
                            <div class="form-group">
                                <label>Rut</label>
                                {{ Form::input('text', 'rutpersona', $rut, ['class' => 'form-control', 'id' => 'rutpersona']) }}
                            </div>

                            <div class="form-group">
                                <label for="password">Nombre</label>
                                {{ Form::input('text', 'nombrepersona', null, ['class' => 'form-control', 'id' => 'nombrepersona']) }}
                            </div>
                            <div class="form-group">
                                <label for="password">Apellido</label>
                                {{ Form::input('text', 'apellidopersona', null, ['class' => 'form-control', 'id' => 'apellidopersona']) }}
                            </div>

                            <div class="form-group">
                                <label for="password">E-mail</label>
                                {{ Form::input('email', 'mailpersona', null, ['class' => 'form-control', 'id' => 'mailpersona']) }}
                            </div>
                            <div class="form-group">
                                <label for="password">Repetir E-mail</label>
                                {{ Form::input('email', 'mailpersona2', null, ['class' => 'form-control', 'id' => 'mailpersona2']) }}
                            </div>
                            <div class="form-group">
                                <label for="password">Teléfono</label>
                                {{ Form::input('text', 'fonopersona', null, ['class' => 'form-control', 'id' => 'fonopersona']) }}
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                {{ Form::input('password', 'passwordpersona', null, ['class' => 'form-control', 'id' => 'passwordpersona']) }}
                            </div>
                        </div>
                    </section>
                </section>
                <section class="col-sm-6 col-md-6 col-lg-6">
                    <section class="container-with-large-icon login-form">
                        <div class="large-icon"><img src="" alt=""></div>
                        <div class="wrap">
                            <h3>Dirección</h3>
                            <div class="form-group">
                                <label for="password">Dirección</label>
                                {{ Form::input('text', 'direccionpersona', null, ['class' => 'form-control', 'id' => 'direccionpersona']) }}
                            </div>

                            <div class="form-group">
                                <label for="password">Región</label>

                            </div>

                            <div class="form-group">
                                <label for="password">Ciudad</label>

                            </div>

                            <div class="form-group">
                                <label for="password">Comuna</label>

                            </div>
                            <button type="submit" id="registro" class="btn btn-mega">Registrarse</button>
                        </div>
                    </section>
                </section>
            </div>
        </section>
    @endif
@stop


@section('javascript')
    <script>

    </script>
@stop