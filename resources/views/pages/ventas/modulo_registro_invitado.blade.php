@extends('layouts.ventas.default')

@section('titulo', 'Invitado')

@section('content')
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <section class="container">
        <nav class="breadcrumbs"><a href="#">Home</a> <span class="divider">›</span> Acceso como invitado</nav>
    </section>

    <style>
        #registroRegistroeForm .error {
            border-color: #c00232;
        }
    </style>
    {{ Form::open(array('url' => '/validainvitado', 'class' => 'validar-formulario')) }}
    <section class="container">
        <div class="row">
            <section class="col-sm-6 col-md-6 col-lg-6">
                <section class="container-with-large-icon login-form">
                    <div class="large-icon"></div>
                    <div class="wrap">
                        <h3>Información Invitado</h3>
                        <div class="form-group">
                            <label>Rut</label>
                            {{ Form::input('text', 'rutpersona', null, ['class' => 'form-control', 'id' => 'rutpersona']) }}
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
                            <label for="mailpersona">E-mail contacto</label>
                            {{ Form::input('email', 'mailpersona', null, ['class' => 'form-control', 'id' => 'mailpersona']) }}
                        </div>
                        <div class="form-group">
                            <label for="fonopersona">Teléfono contacto</label>
                            {{ Form::input('text', 'fonopersona', null, ['class' => 'form-control', 'id' => 'fonopersona']) }}
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
                        <button type="submit" id="registropersona" class="btn btn-mega">Continuar</button>
                    </div>
                </section>
            </section>
        </div>
    </section>
    {{Form::close()}}
@stop


@section('javascript')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');

        $(document).on('change', '#rutpersona', function () {
            var target = $(this),
                    rut = $(this).val();
            if (rut.length > 1) {
                var newRut = '',
                        dv = '';
                for (x = 0; x < rut.length; x++) {
                    if (x == (rut.length - 1)) {
                        dv = rut[x];
                    } else if (!isNaN(rut[x])) {
                        newRut += rut[x];
                    }
                }
                $(target).val(format(newRut) + '-' + dv);
            }
        });

        function format(input) {
            var num = input;
            if (!isNaN(num)) {
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
                num = num.split('').reverse().join('').replace(/^[\.]/, '');
                return num
            } else {
                alert('Solo se permiten numeros');
            }
        }

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