@extends('layouts.arriendo.default')
@section('titulo', 'Checkout')

@section('css')
    <style>
        .m-bot {
            margin-bottom: 15px;
        }
        input.datepicker {
            background-color: #FFF !important;
            cursor: pointer !important;
        }
    </style>

@stop

@php
    $dias = array();
    for ($x = 1; $x <=100; $x++)
    {
        $dias[$x] = $x;
    }
@endphp

@section('content')
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- checkout -->
                <div class="panel-group"  id="checkOut">
                    <!-- REGISTRO - LOGIN -->
                    <div class="panel panel-default">
                        <div class="panel-heading active">
                            <h4 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> <span>1</span>Información del cliente</a> </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="row">
                                    <table class="table table-condensed">
                                        <tr>
                                            <td>Nombre</td>
                                            <td>{{$cliente['_usuarioweb']['Nombre']}}</td>
                                        </tr>

                                        <tr>
                                            <td>Apellidos</td>
                                            <td>{{$cliente['_usuarioweb']['ApeP']}} {{$cliente['_usuarioweb']['ApeM']}}</td>
                                        </tr>
                                        <tr>
                                            <td>RUT</td>
                                            <td>{{ $cliente['_usuarioweb']['Rut']}}-{{ $cliente['_usuarioweb']['Dv']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{$cliente['_usuarioweb']['Email']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Teléfono</td>
                                            <td>{{$cliente['_usuarioweb']['Telefono']}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIN REGISTRO - LOGIN -->
                    {{ Form::open(array('class' => 'validar-formulario', 'id' => 'CompraConfirmarArriendoForm')) }}
                    <!-- DESPACHO -->
                    <div class="panel panel-default">
                        <div class="panel-heading active">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#">
                                    <span>2</span>Despacho
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in">
                            <div class="panel-body">

                                <div class="col-md-12">
                                    <h3>Información del Evento</h3>
                                    <div class="col-md-12 m-bot">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nombre del Evento</label>
                                                    {{ Form::input('data[Evento][nombre]', 'text', null, ['class' => 'form-control', 'id' => 'eventonombre']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tipo de evento</label>
                                                    {{ Form::select('data[Evento][tipo]', array(
                                                        '0' => '- seleccione tipo de evento',
                                                        'ANI' => 'ANIVERSARIO',
                                                        'BAN' => 'FIESTA PARTICULAR',
                                                        'BAU' => 'BAUTIZO',
                                                        'CUM' => 'CUMPLEAÑOS',
                                                        'EEP' => 'FIESTA EMPRESA',
                                                        'EES' => 'MUESTRA',
                                                        'GRA' => 'GRADUACION',
                                                        'MAT' => 'MATRIMONIO',
                                                        'PRE' => 'PRESTAMO',
                                                        'REC' => 'RECITAL O SHOW'), null, ['class' => 'form-control', 'id' => 'eventotipo']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Fecha del Evento</label>
                                                    {{ Form::input('text', 'data[Evento][fecha]', null, ['class' => 'form-control datepicker', 'id' => 'eventofecha']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Días de arriendo</label>
                                                    {{ Form::select('data[Evento][dias]', $dias, null, ['class' => 'form-control', 'id' => 'eventodias']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12" style="margin-top: 30px;">
                                    <h3>Despacho y devoluci&oacute;n</h3>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="checkbox">
                                                <label>
                                                    {!! Form::checkbox('retirotienda', 'checked', true, ['style'=>'transform: scale(1.3);', 'id' => 'retirotienda']) !!}
                                                    <b style="font-size: 1.2em; text-transform: uppercase;">Retiro en Steward Huechuraba</b>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="despacho-domicilio" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a data-toggle="modal" href='#add-direc' class=" btn btn-xs btn-mega pull-right" style="margin-top:-10px">Agregar dirección</a>
                                            </div>
                                        </div>
                                        <h6>Selecciona:</h6>
                                        {{ Form::select('CompraDespachoId', $direcciones, null, ['class' => 'form-control', 'id' => 'CompraDespachoId']) }}
                                        <br>
                                        <table class="table table-condensed">
                                            <tr>
                                                <td style="border: 0;"><b>Dirección :</b></td>
                                                <td style="border: 0;" id="direccion"></td>
                                            </tr>
                                            <tr>
                                                <td style="border: 0;"><b>Comuna :</b></td>
                                                <td style="border: 0;" id="comuna"></td>
                                            </tr>
                                            <tr>
                                                <td style="border: 0;"><b>Región :</b></td>
                                                <td style="border: 0;" id="region"></td>
                                            </tr>
                                            <tr>
                                                <td style="border: 0;"><b>Valor Despacho :</b></td>
                                                <td style="border: 0;" id="valorDespacho"></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-md-12 m-bot" style="margin-top: 20px;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Fecha de entrega</label>
                                                    {!! Form::input('text', 'data[Entrega][fecha]', false, ['readonly', 'class' => 'form-control', 'id' => 'fechaentrega']) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Horario de entrega</label>
                                                    {{ Form::select('data[Entrega][horario]', array(
                                                                    '0' => '- seleccione horario entrega',
                                                                    'DD' => 'DD (Durante el día): 9:00 a 19:00 hrs.',
                                                                    'DM' => 'DM (Durante la mañana): 9:00 a 14:00 hrs.',
                                                                    'DT' => 'DT (Durante la tarde): 14:00 a 19:00 hrs.'), null, ['class' => 'form-control', 'id' => 'horarioentrega']) }}


                                                </div>
                                            </div>
                                            <div class="col-md-4 determinada hidden">
                                                <div class="form-group">
                                                    <label style="width: 100%;">&nbsp;</label>


                                                    <b> : </b>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-bot">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Fecha de retorno</label>
                                                    {!! Form::input('text', 'data[Retorno][fecha]', false, ['readonly', 'class' => 'form-control', 'id' => 'fecharetorno']) !!}

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Horario de retorno</label>
                                                    {{ Form::select('data[Retorno][horario]', array(
                                                                '0' => '- seleccione horario retorno',
                                                                'DD' => 'DD (Durante el día): 9:00 a 19:00 hrs.',
                                                                'DM' => 'DM (Durante la mañana): 9:00 a 14:00 hrs.',
                                                                'DT' => 'DT (Durante la tarde): 14:00 a 19:00 hrs.'), null, ['class' => 'form-control', 'id' => 'horarioretorno']) }}

                                                </div>
                                            </div>
                                            <div class="col-md-4 determinada hidden">
                                                <div class="form-group">
                                                    <label style="width: 100%;">&nbsp;</label>


                                                    <b> : </b>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a href="#collapseFive" class=" btn btn-mega pull-right">Continuar</a>

                            </div>
                        </div>
                    </div>
                    <!-- FIN DESPACHO -->
                    <!-- INFORMACION -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" href="#collapseFive">
                                    <span>3</span>Información
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <h3>Información de contacto</h3>
                                    <div class="col-md-12 m-bot">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Nombre de contacto</label>
                                                    {{ Form::input('contactonombre', 'text', null, ['class' => 'form-control', 'id' => 'contactonombre']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-md-offset-2">
                                                <div class="form-group">
                                                    <label>Teléfono de contacto</label>
                                                    {{ Form::input('contactofono', 'text', null, ['class' => 'form-control', 'id' => 'contactofono', 'placeholder' => 'Ej: 0977777777']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-bot">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Email de contacto</label>
                                                    {{ Form::input('email', 'contactomail', null, ['class' => 'form-control', 'id' => 'contactomail', 'placeholder' => 'Ej: email@email.com']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-bot">
                                        <div class="form-group">
                                            <label>Comentario</label>
                                            {{ Form::textarea('contactocomentario', null, ['class' => 'form-control', 'id' => 'contactocomentario']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <a href="#collapseSix" class=" btn btn-mega pull-right">Continuar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIN INFORMACION -->
                    <!-- RESUMEN -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" href="#collapseSix">
                                    <span>4</span>Revise Su Orden
                                </a>
                            </h4>
                        </div>
                        <div id="collapseSix" class="panel-collapse collapse">
                            <div class="panel-body">
                                <section class="content-box">
                                    <div class="shopping_cart">
                                        <div class="box">

                                            <h3>Detalle de la Compra</h3>
                                            <table>
                                                <thead>
                                                <tr class="hidden-xs">
                                                    <th></th>
                                                    <th>Producto</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($productos as $producto)
                                                    <tr>
                                                        <td><a href="#" class="remove-button visible-xs"><span class="icon-cancel-2 "></span></a>
                                                            <a href="">
                                                                <img class="preview" src="{{URL::asset('/imagenweb/sku/' . $producto->foto)}}">
                                                            </a>
                                                        </td>
                                                        <td><span class="td-name visible-xs">Producto</span><a href="#">{{$producto->nombre}}</a></td>
                                                        <td><span class="td-name visible-xs">Precio</span>${{number_format($producto->precio, 0, ",", ".")}}</td>
                                                        <td>
                                                            <span class="td-name visible-xs">Cantidad</span>
                                                            <div class="input-group quantity-control">
                                                                {{$producto->cantidad}}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="td-name visible-xs">Total</span>
                                                            ${{number_format(($producto->precio * $producto->cantidad) , 0, ",", ".")}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="pull-left"> <b class="title">Despacho:</b> <span id="valorDespacho2"></span></div>
                                            <div class="pull-right">
                                                <table class="table condensed">
                                                    <tr>
                                                        <td style="text-align: left;"><b>Neto:</b></td>
                                                        <td style="text-align: right;"><span id="neto" class="price">$</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;"><b>Iva:</b></td>
                                                        <td style="text-align: right;"><span id="iva" class="price">$</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;"><b>Total:</b></td>
                                                        <td style="text-align: right;"><span id="precioTotal" class="price">$</span></td>
                                                    </tr>
                                                </table>

                                                <div class="col-md-12" style="margin-bottom: 20px;">
                                                    <div class="row">
                                                        <a href="#" id="continuar" class="continuar btn btn-mega">Enviar solicitud</a>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <p>Nos contactaremos con usted a la brevedad para formalizar su pedido.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>

                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <!-- FIN RESUMEN -->
                    {{ Form::close() }}
                </div>
                <!-- end check out -->
                <div class="divider divider-sm visible-sm  visible-xs"></div>
            </div>
        </div>
    </div>


    <!-- DIRECCION ADD -->
    <div class="modal fade" id="add-direc">
        <div class="modal-dialog">
            <div class="modal-content">

                {{ Form::open(array('class' => 'form-horizontal validar-formulario')) }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Agregar dirección</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ClienteDireccion" class="col-sm-2 control-label">Dirección:</label>
                                <div class="col-sm-10">
                                    {{ Form::input('text', 'ClienteDireccion', null, ['class' => 'form-control', 'id' => 'ClienteDireccion']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ClienteRegion" class="col-sm-2 control-label">Región:</label>
                                <div class="col-sm-10">
                                    {{ Form::select('ClienteRegion', $regiones, null, ['class' => 'form-control', 'id' => 'ClienteRegion']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ClienteCiudad" class="col-sm-2 control-label">Ciudad:</label>
                                <div class="col-sm-10">
                                    {{ Form::select('ClienteCiudad', array(), null, ['class' => 'form-control', 'id' => 'ClienteCiudad', 'empty' => '- sin info']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ClienteComuna" class="col-sm-2 control-label">Comuna:</label>
                                <div class="col-sm-10">
                                    {{ Form::select('ClienteComuna', array(), null, ['class' => 'form-control', 'id' => 'ClienteComuna']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="addDireccion" class="btn btn-primary btn-mega">Agregar</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <!-- END ADD -->

@stop


@section('javascript')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');


        function desplegar_despacho() {
            $('#collapseFive').collapse('hide');
            $('a[href="#collapseFive"]').parents('.panel-heading').removeClass('active');
            $('#collapseSix').collapse('hide');
            $('a[href="#collapseSix"]').parents('.panel-heading').removeClass('active');
            if ($('#collapseThree #retirotienda').is(':checked')) {
                $('#collapseThree #despacho-domicilio').slideUp(900);
            } else {
                $('#collapseThree #despacho-domicilio').slideDown(900);
            }
        }


        $(document).ready(function() {
            $('#eventofecha').datepicker({
                autoclose : true,
                format : 'dd-mm-yyyy',
                startDate: '{{date('d-m-Y')}}',
                language: 'es'
            });



            //desplegar_despacho();

            $('#collapseThree #retirotienda').change(function() {
                desplegar_despacho();
            });


            $('#eventofecha, #eventodias').change(function() {
                var fecha = $('#eventofecha').val();
                var date = fecha.split('-');
                date = Date.UTC(date[2],(parseInt(date[1])-1),parseInt(date[0])+1);
                var today = '{{date('d-m-Y')}}';
                today = today.split('-');
                today = Date.UTC(today[2],(parseInt(today[1])-1),parseInt(today[0])+1);
                if (date <= today) {
                    defaultDate = new Date(today);
                } else {
                    defaultDate = new Date(date - 86400000);
                }
                defaultDate = [parseInt(defaultDate.getDate()), (parseInt(defaultDate.getMonth())+1), parseInt(defaultDate.getFullYear())];
                if (defaultDate[0] < 10) {
                    defaultDate[0] = "0"+defaultDate[0];
                }
                if (defaultDate[1] < 10) {
                    defaultDate[1] = "0"+defaultDate[1];
                }
                var fechaEntrega = defaultDate[0]+"-"+defaultDate[1]+"-"+defaultDate[2];

                defaultDate = new Date(date + parseInt($('#eventodias').val())*86400000);
                defaultDate = [parseInt(defaultDate.getDate()), (parseInt(defaultDate.getMonth())+1), parseInt(defaultDate.getFullYear())];

                if (defaultDate[0] < 10) {
                    defaultDate[0] = "0"+defaultDate[0];
                }
                if (defaultDate[1] < 10) {
                    defaultDate[1] = "0"+defaultDate[1];
                }
                // establecer fecha desde como 3 dias antes del evento
                var limitIniDays = 3;
                var limitIni = date;
                for (x = 1;x<= limitIniDays;x++) {
                    limitIni = date - (86400000*x);
                    if (limitIni <= today) {
                        limitIni = today;
                    }
                }
                limitIni = new Date(limitIni);
                $('#fechaentrega').addClass('datepicker').datepicker('remove').datepicker({
                    autoclose : true,
                    format : 'dd-mm-yyyy',
                    startDate: limitIni,
                    endDate : fecha,
                    language: 'es'
                }).datepicker('update', fechaEntrega);
                var fechaRetiro = defaultDate[0]+"-"+defaultDate[1]+"-"+defaultDate[2];
                // establecer fecha hasta como 1 dia despues del evento
                var limitIniDays = 1;
                var limitEnd = new Date( (date + parseInt(limitIniDays * 86400000) + parseInt($('#eventodias').val() * 86400000)) );
                $('#fecharetorno').addClass('datepicker').datepicker('remove').datepicker({
                    autoclose : true,
                    format : 'dd-mm-yyyy',
                    startDate : fecha,
                    endDate : limitEnd,
                    language: 'es'
                }).datepicker('update', fechaRetiro);
            });




            $(document).on('click','a[href="#collapseFive"]',function(e) {
                e.preventDefault();
                var despacho = $('#CompraConfirmarArriendoForm #CompraDespachoId');
                var formulario =  $('#CompraConfirmarArriendoForm');
                if (! $(despacho).length) {
                    return false;
                }

                $('#CompraConfirmarArriendoForm #collapseThree .form-control[name^="data[Evento]"]').each(function(index, elemento) {
                    $(elemento).parents('.form-group').removeClass('has-error');
                    if (! $(elemento).val()) {
                        $(elemento).parents('.form-group').addClass('has-error');
                    }
                });

                $('#CompraConfirmarArriendoForm #collapseThree .form-control[name^="data[Entrega]"]').each(function(index, elemento) {
                    $(elemento).parents('.form-group').removeClass('has-error');
                    if (! $(elemento).val()) {
                        $(elemento).parents('.form-group').addClass('has-error');
                    }
                });

                $('#CompraConfirmarArriendoForm #collapseThree .form-control[name^="data[Retorno]"]').each(function(index, elemento) {
                    $(elemento).parents('.form-group').removeClass('has-error');
                    if (! $(elemento).val()) {
                        $(elemento).parents('.form-group').addClass('has-error');
                    }
                });

                if ($(formulario).find('.has-error').length) {
                    $.alerta('Para enviar la cotización debe llenar todos los campos destacados.');
                    return false;
                }

                if (! $('#collapseThree #CompraRetiroTienda').is(':checked')) {
                    if (! $(despacho).val()) {
                        $.alerta('Debe seleccionar una dirección.');
                        return false;
                    }
                }

                $('a[href="#collapseFive"]').parents('.panel-heading').addClass('active');
                $('#collapseFive').collapse('show');

                $('html, body').animate({
                    scrollTop: $("#collapseFive").parent().offset().top
                }, 600);
            });

            $(document).on('click','a[href="#collapseSix"]',function(e) {
                e.preventDefault();
                if (! $('#collapseFive').hasClass('in')) {
                    return false;
                }
                // validar formulario evento
                if (! $('#collapseFive .form-control').length) {
                    return false;
                }
                $('#collapseFive .has-error').removeClass('has-error');
                $('#collapseFive .form-control').each(function(index, elemento) {
                    if (! $(elemento).val()) {
                        $(elemento).parents('.form-group').addClass('has-error');
                    }
                });
                if ($('#collapseFive .has-error').length) {
                    $.alerta('Para continuar debe ingresar los campos destacados.');
                    return false;
                }
                // validar email
                if (! $('#collapseFive #contactomail').isEmail()) {
                    $('#collapseFive #contactomail').parents('.form-group').addClass('has-error');
                    $.alerta('Para continuar debe ingresar un email válido.');
                    return false;
                }
                $('a[href="#collapseSix"]').parents('.panel-heading').addClass('active');
                $('#collapseSix').collapse('show');
                $('html, body').animate({
                    scrollTop: $("#collapseSix").parent().offset().top
                }, 600);
            });
        });

    </script>
@stop