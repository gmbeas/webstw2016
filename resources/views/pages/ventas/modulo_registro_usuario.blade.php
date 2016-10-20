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
        {{ Form::open(array('url' => '/validaregistro', 'class' => 'validar-formulario')) }}
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
                                {{ Form::input('text', 'razonsocialempresa', $razonsocial, ['class' => 'form-control', 'id' => 'razonsocialempresa']) }}
                            </div>

                            <div class="form-group">
                                <label for="giroempresa">Giro:</label>
                                {{ Form::select('giroempresa', $giros, null, ['class' => 'form-control', 'id' => 'giroempresa']) }}
                            </div>


                            <div class="form-group">
                                <label for="direccionempresa">Dirección</label>
                                {{ Form::input('text', 'direccionempresa', null, ['class' => 'form-control', 'id' => 'direccionempresa']) }}
                            </div>

                            <div class="form-group">
                                <label for="regionempresa">Región</label>
                                {{ Form::select('regionempresa', $regiones, null, ['class' => 'form-control', 'id' => 'regionempresa']) }}
                            </div>

                            <div class="form-group">
                                <label for="ciudadempresa">Ciudad</label>
                                {{ Form::select('ciudadempresa', array(), null, ['class' => 'form-control', 'id' => 'ciudadempresa', 'empty' => '- sin info']) }}
                            </div>

                            <div class="form-group">
                                <label for="comunaempresa">Comuna</label>
                                {{ Form::select('comunaempresa', array(), null, ['class' => 'form-control', 'id' => 'comunaempresa', 'empty' => '- sin info']) }}
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
                                <label for="nombreempresa">Nombre:</label>
                                {{ Form::input('text', 'nombreempresa', null, ['class' => 'form-control', 'id' => 'nombreempresa']) }}
                            </div>
                            <div class="form-group">
                                <label for="apellidoempresa">Apellido:</label>
                                {{ Form::input('text', 'apellidoempresa', null, ['class' => 'form-control', 'id' => 'apellidoempresa']) }}
                            </div>
                            <div class="form-group">
                                <label for="rutcontactoempresa">Rut:</label>
                                {{ Form::input('text', 'rutcontactoempresa', null, ['class' => 'form-control', 'id' => 'rutcontactoempresa']) }}
                            </div>
                            <div class="form-group">
                                <label for="mailempresa">E-mail:</label>
                                {{ Form::input('email', 'mailempresa', null, ['class' => 'form-control', 'id' => 'mailempresa']) }}
                            </div>

                            <div class="form-group">
                                <label for="mailempresa2">Repetir E-mail</label>
                                {{ Form::input('email', 'mailempresa2', null, ['class' => 'form-control', 'id' => 'mailempresa']) }}
                            </div>

                            <div class="form-group">
                                <label for="fonoempresa">Telefono:</label>
                                {{ Form::input('text', 'fonoempresa', null, ['class' => 'form-control', 'id' => 'fonoempresa']) }}
                            </div>
                            <div class="form-group">
                                <label for="passwordempresa">Contraseña:</label>
                                {{ Form::input('password', 'passwordempresa', null, ['class' => 'form-control', 'id' => 'passwordempresa']) }}
                            </div>
                            <button type="submit" id="registroempresa" class="btn btn-mega">Registrarse</button>
                        </div>
                    </section>
                </section>
            </div>
        </section>
        {{Form::close()}}
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
                                <label for="nombrepersona">Nombre</label>
                                {{ Form::input('text', 'nombrepersona', null, ['class' => 'form-control', 'id' => 'nombrepersona']) }}
                            </div>
                            <div class="form-group">
                                <label for="apellidopersona">Apellido</label>
                                {{ Form::input('text', 'apellidopersona', null, ['class' => 'form-control', 'id' => 'apellidopersona']) }}
                            </div>

                            <div class="form-group">
                                <label for="mailpersona">E-mail</label>
                                {{ Form::input('email', 'mailpersona', null, ['class' => 'form-control', 'id' => 'mailpersona']) }}
                            </div>
                            <div class="form-group">
                                <label for="mailpersona2">Repetir E-mail</label>
                                {{ Form::input('email', 'mailpersona2', null, ['class' => 'form-control', 'id' => 'mailpersona2']) }}
                            </div>
                            <div class="form-group">
                                <label for="fonopersona">Teléfono</label>
                                {{ Form::input('text', 'fonopersona', null, ['class' => 'form-control', 'id' => 'fonopersona']) }}
                            </div>
                            <div class="form-group">
                                <label for="passwordpersona">Contraseña</label>
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
                                <label for="direccionpersona">Dirección</label>
                                {{ Form::input('text', 'direccionpersona', null, ['class' => 'form-control', 'id' => 'direccionpersona']) }}
                            </div>

                            <div class="form-group">
                                <label for="regionpersona">Región</label>
                                {{ Form::select('regionpersona', $regiones, null, ['class' => 'form-control', 'id' => 'regionpersona']) }}
                            </div>

                            <div class="form-group">
                                <label for="ciudadpersona">Ciudad</label>
                                {{ Form::select('ciudadpersona', array(), null, ['class' => 'form-control', 'id' => 'ciudadpersona', 'empty' => '- sin info']) }}
                            </div>

                            <div class="form-group">
                                <label for="comunapersona">Comuna</label>
                                {{ Form::select('comunapersona', array(), null, ['class' => 'form-control', 'id' => 'comunapersona', 'empty' => '- sin info']) }}
                            </div>
                            <button type="submit" id="registropersona" class="btn btn-mega">Registrarse</button>
                        </div>
                    </section>
                </section>
            </div>
        </section>
    @endif
@stop


@section('javascript')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');

        $('#regionempresa').change(function () {
            var region = $(this).val(), target = $('#ciudadempresa');
            if (!$(target).length) {
                return false;
            }
            $(target).html('<option>cargando...</option>');
            $('#comunaempresa').html('<option></option>');
            $.ajax({
                type: "POST",
                url: '{{URL::to('getciudades')}}',
                data: {'idregion': region, '_token': token},
                success: function (response) {
                    var respuesta = JSON.parse(response);
                    $(target).html('');
                    $.each(respuesta, function (i, value) {
                        $(target).append($('<option>').text(value.Nombre).attr('value', value.Id));
                    });
                }
            });
        });

        $('#ciudadempresa').change(function () {
            var ciudad = $(this).val(),
                    region = $('#regionempresa').val(),
                    target = $('#comunaempresa');
            if (!$(target).length) {
                return false;
            }
            $(target).html('<option>cargando...</option>');
            $.ajax({
                type: "POST",
                url: '{{URL::to('getcomunas')}}',
                data: {'idregion': region, 'idciudad': ciudad, '_token': token},
                success: function (response) {
                    var respuesta = JSON.parse(response);
                    $(target).html('');
                    $.each(respuesta, function (i, value) {
                        $(target).append($('<option>').text(value.Nombre).attr('value', value.Id));
                    });
                }
            });
        });


        $('#regionpersona').change(function () {
            var region = $(this).val(), target = $('#ciudadpersona');
            if (!$(target).length) {
                return false;
            }
            $(target).html('<option>cargando...</option>');
            $('#comunapersona').html('<option></option>');
            $.ajax({
                type: "POST",
                url: '{{URL::to('getciudades')}}',
                data: {'idregion': region, '_token': token},
                success: function (response) {
                    var respuesta = JSON.parse(response);
                    $(target).html('');
                    $.each(respuesta, function (i, value) {
                        $(target).append($('<option>').text(value.Nombre).attr('value', value.Id));
                    });
                }
            });
        });

        $('#ciudadpersona').change(function () {
            var ciudad = $(this).val(),
                    region = $('#regionpersona').val(),
                    target = $('#comunapersona');
            if (!$(target).length) {
                return false;
            }
            $(target).html('<option>cargando...</option>');
            $.ajax({
                type: "POST",
                url: '{{URL::to('getcomunas')}}',
                data: {'idregion': region, 'idciudad': ciudad, '_token': token},
                success: function (response) {
                    var respuesta = JSON.parse(response);
                    $(target).html('');
                    $.each(respuesta, function (i, value) {
                        $(target).append($('<option>').text(value.Nombre).attr('value', value.Id));
                    });
                }
            });
        });

    </script>
@stop