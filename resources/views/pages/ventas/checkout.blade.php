@extends('layouts.ventas.default')
@section('titulo', 'Checkout')

@section('css')

@stop

@php

@endphp

@section('content')
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- checkout -->
                <div class="panel-group"  id="checkOut">

                @if($invitado == 0)
                    <!-- REGISTRO - LOGIN -->
                        <div class="panel panel-default">
                            <div class="panel-heading active">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseOne">
                                        <span>1</span>Información del cliente</a>
                                </h4>
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
                                                <td>{{ $cliente['_usuarioweb']['Rut']}}
                                                    -{{ $cliente['_usuarioweb']['Dv']}}</td>
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
                    {{ Form::open(array('url' => '/pago', 'class' => 'form-horizontal validar-formulario', 'id' => 'CompraPagoForm')) }}
                    <!-- DESPACHO -->
                        <div class="panel panel-default">
                            <div class="panel-heading active">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                       href="#">
                                        <span>2</span>Despacho
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a data-toggle="modal" href='#add-direc'
                                               class=" btn btn-xs btn-mega pull-right" style="margin-top:-10px">Agregar
                                                dirección</a>
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
                                    <a href="#collapseFive" class=" btn btn-mega pull-right">Continuar</a>
                                </div>
                            </div>
                        </div>
                        <!-- FIN DESPACHO -->
                        <!-- PAGO -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" href="#collapseFive">
                                        <span>3</span>Forma de Pago
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <input type="radio" name="mediopago" id="mediopago" value="1" checked="checked"
                                           style="margin-right: 10px;"> Web Play Plus
                                    <a href="#collapseSix" class=" btn btn-mega pull-right">Continuar</a>
                                </div>
                            </div>
                        </div>
                        <!-- FIN PAGO -->
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
                                                            <td><a href="#" class="remove-button visible-xs"><span
                                                                            class="icon-cancel-2 "></span></a>
                                                                <a href="">
                                                                    <img class="preview"
                                                                         src="{{Asset::skus($producto->foto)}}">
                                                                </a>
                                                            </td>
                                                            <td><span class="td-name visible-xs">Producto</span><a
                                                                        href="#">{{$producto->nombre}}</a></td>
                                                            <td>
                                                                <span class="td-name visible-xs">Precio</span>${{number_format($producto->precio, 0, ",", ".")}}
                                                            </td>
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
                                                {{ Form::hidden('valordespachoinput', '0') }}
                                                {{ Form::hidden('valoridregion', '0') }}
                                                {{ Form::hidden('valoridciudad', '0') }}
                                                <div class="pull-left"><b class="title">Despacho:</b> <span
                                                            id="valorDespacho2"></span></div>

                                                <div class="pull-right">
                                                    <table class="table condensed">
                                                        <tr>
                                                            <td style="text-align: left;"><b>Neto:</b></td>
                                                            <td style="text-align: right;"><span id="neto"
                                                                                                 class="price">$</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: left;"><b>Iva:</b></td>
                                                            <td style="text-align: right;"><span id="iva" class="price">$</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: left;"><b>Total:</b></td>
                                                            <td style="text-align: right;"><span id="precioTotal"
                                                                                                 class="price">$</span>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <div class="col-md-12" style="margin-bottom: 20px;">
                                                        <div class="row">
                                                            {{Form::checkbox('politicas', 'value', false, ['id' => 'politicas'])}}
                                                            <a href="" target="_blank" style="margin-left: 7px;">acepto
                                                                los términos y condiciones</a>
                                                        </div>
                                                    </div>
                                                    <a href="#" id="continuar" class="continuar btn btn-mega">Pagar</a>
                                                </div>
                                                <div class="clearfix"></div>

                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <!-- FIN RESUMEN -->
                    {{Form::close()}}
                @elseif($invitado == 1)
                    <!-- REGISTRO - LOGIN -->
                        <div class="panel panel-default">
                            <div class="panel-heading active">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseOne">
                                        <span>1</span>Datos para contacto y despacho
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOneInvitado" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label for="nombrepersona">Nombre</label>
                                                {{ Form::input('text', 'nombrepersona', null, ['class' => 'form-control', 'id' => 'nombrepersona']) }}
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Rut</label>
                                                {{ Form::input('text', 'rutpersona', null, ['class' => 'form-control', 'id' => 'rutpersona']) }}
                                            </div>
                                        </div>
                                        </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="fonopersona">Teléfono contacto</label>
                                                {{ Form::input('text', 'fonopersona', null, ['class' => 'form-control', 'id' => 'fonopersona']) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="mailpersona">E-mail contacto</label>
                                                {{ Form::input('text', 'mailpersona', null, ['class' => 'form-control', 'id' => 'mailpersona']) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="direccionpersona">Dirección</label>
                                                {{ Form::input('text', 'direccionpersona', null, ['class' => 'form-control', 'id' => 'direccionpersona']) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="regionpersona">Región</label>
                                                {{ Form::select('regionpersona', $regiones, null, ['class' => 'form-control', 'id' => 'regionpersona']) }}
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="ciudadpersona">Ciudad</label>
                                                {{ Form::select('ciudadpersona', array(), null, ['class' => 'form-control', 'id' => 'ciudadpersona', 'empty' => '- sin info']) }}
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="comunapersona">Comuna</label>
                                                {{ Form::select('comunapersona', array(), null, ['class' => 'form-control', 'id' => 'comunapersona', 'empty' => '- sin info']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#collapseTwoInvitado" class=" btn btn-mega pull-right">Continuar</a>
                                    </div>
                            </div>
                            </div>
                        <!-- FIN REGISTRO - LOGIN -->
                        <!-- PAGO -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" href="#collapseTwoInvitado">
                                        <span>2</span>Forma de Pago
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwoInvitado" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <input type="radio" name="mediopago" id="mediopago" value="1" checked="checked"
                                           style="margin-right: 10px;"> Web Play Plus
                                    <a href="#collapseThreeInvitado" class=" btn btn-mega pull-right">Continuar</a>
                                </div>
                            </div>
                        </div>
                        <!-- FIN PAGO -->
                        <!-- RESUMEN -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" href="#collapseThreeInvitado">
                                        <span>3</span>Revise Su Orden
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThreeInvitado" class="panel-collapse collapse">
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
                                                            <td><a href="#" class="remove-button visible-xs"><span
                                                                            class="icon-cancel-2 "></span></a>
                                                                <a href="">
                                                                    <img class="preview"
                                                                         src="{{Asset::skus($producto->foto)}}">
                                                                </a>
                                                            </td>
                                                            <td><span class="td-name visible-xs">Producto</span><a
                                                                        href="#">{{$producto->nombre}}</a></td>
                                                            <td>
                                                                <span class="td-name visible-xs">Precio</span>${{number_format($producto->precio, 0, ",", ".")}}
                                                            </td>
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
                                                {{ Form::hidden('valordespachoinput', '0') }}
                                                {{ Form::hidden('valoridregion', '0') }}
                                                {{ Form::hidden('valoridciudad', '0') }}
                                                <div class="pull-left"><b class="title">Despacho:</b> <span
                                                            id="valorDespacho2"></span></div>

                                                <div class="pull-right">
                                                    <table class="table condensed">
                                                        <tr>
                                                            <td style="text-align: left;"><b>Neto:</b></td>
                                                            <td style="text-align: right;"><span id="neto"
                                                                                                 class="price">$</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: left;"><b>Iva:</b></td>
                                                            <td style="text-align: right;"><span id="iva" class="price">$</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: left;"><b>Total:</b></td>
                                                            <td style="text-align: right;"><span id="precioTotal"
                                                                                                 class="price">$</span>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <div class="col-md-12" style="margin-bottom: 20px;">
                                                        <div class="row">
                                                            {{Form::checkbox('politicas', 'value', false, ['id' => 'politicas'])}}
                                                            <a href="" target="_blank" style="margin-left: 7px;">acepto
                                                                los términos y condiciones</a>
                                                        </div>
                                                    </div>
                                                    <a href="#" id="continuar" class="continuar btn btn-mega">Pagar</a>
                                                </div>
                                                <div class="clearfix"></div>

                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <!-- FIN RESUMEN -->
                    @endif
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

        function cambiarDespacho(despachoId) {
            if ($('#collapseFive').is(':visible')) {
                $('#collapseFive').collapse('hide');
                $('a[href="#collapseFive"]').parents('.panel-heading').removeClass('active');
            }
            if ($('#collapseSix').is(':visible')) {
                $('#collapseSix').collapse('hide');
                $('a[href="#collapseSix"]').parents('.panel-heading').removeClass('active');
            }

            $.ajax({
                type: "POST",
                url: '{{URL::to('cambiadespacho')}}',
                data: {'despachoId': despachoId, '_token' : token},
                success: function(response) {
                    var respuesta = JSON.parse(response);
                    console.log(respuesta);
                    $('#direccion').html (respuesta.direccion.dire);
                    $('#comuna').html (respuesta.direccion.comu);
                    $('#region').html (respuesta.direccion.regi);
                    $('input[name="valoridregion"]').val(respuesta.direccion.ciuid);
                    $('input[name="valoridciudad"]').val(respuesta.direccion.regiid);
                    //$('#valordespachoinput').val(respuesta.total.flete);
                    $('input[name="valordespachoinput"]').val(respuesta.total.flete);

                    $('#valorDespacho').html ('$'+format(respuesta.total.flete)+' + IVA');
                    $('#valorDespacho2').html ('$'+format(respuesta.total.flete)+' + IVA');
                    $('#precioTotal').html ('$'+format(respuesta.total.bruto));
                    $('#iva').html ('$'+format(respuesta.total.iva));
                    $('#neto').html ('$'+format(respuesta.total.neto));
                }
            });
        }


        $('.continuar').click(function (e) {
            e.preventDefault();
            var despacho = $('#CompraPagoForm #CompraDespachoId');
            console.log(despacho);
            if (!$(despacho).length) {
                return false;
            }
            if (!$(despacho).val()) {
                return false;
            }
            if (!$('#politicas').is(':checked')) {
                //$.alerta('Para continuar, debe aceptar las politicas.');
                return false;
            }
            $('#CompraPagoForm').submit();
        });


        $('#add-direc #addDireccion').click(function() {
            var formulario = $(this).parents('form');
            $(formulario).find('.has-error').removeClass('has-error');
            $(formulario).find('.form-control').each(function(index, elemento) {
                if (! $(elemento).val()) {
                    $(elemento).parents('.form-group').addClass('has-error');
                }
            });
            if ($(formulario).find('.has-error').length) {
                $.alerta('Para guardar la nueva dirección debe llenar los campos destacados.');
                return false;
            }

           // $('#CompraAgregarDireccionForm').submit();

            var dire = $('#ClienteDireccion').val();
            var idregion = $('#ClienteRegion').val();
            var idciudad = $('#ClienteCiudad').val();
            var idcomuna = $('#ClienteComuna').val();
            var nomregion = $('#ClienteRegion option:selected').text();
            var nomciudad = $('#ClienteCiudad option:selected').text();
            var nomcomuna = $('#ClienteComuna option:selected').text();

            $.ajax({
                type: "POST",
                url: '{{URL::to('nuevadireccion')}}',
                data: {'direccion': dire, 'idregion' : idregion, 'idciudad' : idciudad, 'idcomuna' : idcomuna, 'nomregion' : nomregion, 'nomciudad' : nomciudad, 'nomcomuna' : nomcomuna, '_token' : token},
                success: function(response) {
                    var respuesta = JSON.parse(response);
                    console.log(respuesta);

                    var target = $('#CompraDespachoId');
                    $(target).append($('<option>').text($('#ClienteDireccion').val()+ ', '+ $('#ClienteCiudad option:selected').text() + ', ' + $('#ClienteComuna option:selected').text()).attr('value', respuesta.DirCod));


                    target.val(respuesta.DirCod);
                    cambiarDespacho(respuesta.DirCod);

                    $('#add-direc').modal('toggle');
                    $('#ClienteDireccion').val('');
                    $('#ClienteRegion').val('0');
                    $('#ClienteCiudad').empty();
                    $('#ClienteComuna').empty();

                }
            });
        });

        $(document).on('click', 'a[href="#collapseTwoInvitado"]', function (e) {
            e.preventDefault();
            var rut = $('#rutpersona').val().replaceAll('.', '');
            var nombre = $('#nombrepersona').val();
            var fono = $('#fonopersona').val();
            var mail = $('#mailpersona').val();
            var direccion = $('#direccionpersona').val();
            var regid = $('#regionpersona').val();
            var ciuid = $('#ciudadpersona').val();
            var comid = $('#comunapersona').val();

            var error = false;
            if ($(rut).length) {
                error = true;
            }

            if ($(nombre).length) {
                error = true;
            }

            if ($(fono).length) {
                error = true;
            }

            if (mail.length < 4) {
                error = true;
            }

            if ($(direccion).length) {
                error = true;
            }

            if (regid == 0) {
                error = true;
            }

            if (ciuid == 0 || ciuid == null) {
                error = true;
            }

            if (comid == 0 || comid == null) {
                error = true;
            }

            if (error) {
                swal("Debe ingresar todos los datos para continuar!")
                return false;
            }

            $.ajax({
                type: "POST",
                url: '{{URL::to('validainvitado')}}',
                data: {'rut': rut, 'regid': regid, 'ciuid': ciuid, 'comid': comid, '_token': token},
                success: function (response) {
                    var respuesta = JSON.parse(response);
                    if (respuesta.Error == true) {
                        swal("El rut ingresado esta registrado.!")
                        return false;
                    } else {
                        $('#valorDespacho').html('$' + format(respuesta.total.flete) + ' + IVA');
                        $('#valorDespacho2').html('$' + format(respuesta.total.flete) + ' + IVA');
                        $('#precioTotal').html('$' + format(respuesta.total.bruto));
                        $('#iva').html('$' + format(respuesta.total.iva));
                        $('#neto').html('$' + format(respuesta.total.neto));

                        $('a[href="#collapseTwoInvitado"]').parents('.panel-heading').addClass('active');
                        $('#collapseTwoInvitado').collapse('show');
                        $('html, body').animate({
                            scrollTop: $("#collapseTwoInvitado").parent().offset().top
                        }, 600);
                    }

                }
            });

        });

        $(document).on('click', 'a[href="#collapseThreeInvitado"]', function (e) {
            $('a[href="#collapseThreeInvitado"]').parents('.panel-heading').addClass('active');
            $('#collapseThreeInvitado').collapse('show');
            $('html, body').animate({
                scrollTop: $("#collapseThreeInvitado").parent().offset().top
            }, 600);
        });

        $(document).on('click', 'a[href="#collapseThreeInvitado"]', function (e) {
            $('a[href="#collapseThreeInvitado"]').parents('.panel-heading').addClass('active');
            $('#collapseThreeInvitado').collapse('show');
            $('html, body').animate({
                scrollTop: $("#collapseThreeInvitado").parent().offset().top
            }, 600);
        });


        $(document).on('click','a[href="#collapseFive"]',function(e) {
            e.preventDefault();
            var despacho = $('#CompraDespachoId');
            if (! $(despacho).length) {
                return false;
            }
            if (! $(despacho).val()) {
                return false;
            }

            if($(despacho).val() === '0'){
                return false;
            }

            $('a[href="#collapseFive"]').parents('.panel-heading').addClass('active');
            $('#collapseFive').collapse('show');
            $('html, body').animate({
                scrollTop: $("#collapseFive").parent().offset().top
            }, 600);
        });


        $(document).on('click','a[href="#collapseSix"]',function(e) {
            e.preventDefault();
            var medio = $('#mediopago');
            if (! $(medio).length) {
                return false;
            }
            if ($(medio).is(':checked')) {
                $('a[href="#collapseSix"]').parents('.panel-heading').addClass('active');
                $('#collapseSix').collapse('show');
                $('html, body').animate({
                    scrollTop: $("#collapseSix").parent().offset().top
                }, 600);
            }
        });



        $('#ClienteRegion').change(function() {
            var region = $(this).val(), target = $('#ClienteCiudad');
            if (! $(target).length) {
                return false;
            }
            $(target).html('<option>cargando...</option>');


            $.ajax({
                type: "POST",
                url: '{{URL::to('getciudades')}}',
                data: {'idregion': region, '_token' : token},
                success: function(response) {
                    var respuesta = JSON.parse(response);
                    $(target).html('');
                    $.each(respuesta, function(i, value) {
                        $(target).append($('<option>').text(value.Nombre).attr('value', value.Id));
                    });
                }
            });
        });

        $('#ClienteCiudad').change(function() {
            var ciudad = $(this).val(),
                    region = $('#ClienteRegion').val(),
                    target = $('#ClienteComuna');
            if (! $(target).length) {
                return false;
            }
            $(target).html('<option>cargando...</option>');
            $.ajax({
                type: "POST",
                url: '{{URL::to('getcomunas')}}',
                data: {'idregion': region, 'idciudad' : ciudad, '_token' : token},
                success: function(response) {
                    var respuesta = JSON.parse(response);
                    $(target).html('');
                    $.each(respuesta, function(i, value) {
                        $(target).append($('<option>').text(value.Nombre).attr('value', value.Id));
                    });
                }
            });
        });

        $('#CompraDespachoId').change(function() {
            var id = $(this).val();
            cambiarDespacho(id);
        });

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

        String.prototype.replaceAll = function (find, replace) {
            var str = this;
            return str.replace(new RegExp(find.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'), 'g'), replace);
        };

        function format(input) {
            var num = input;
            if(!isNaN(num)) {
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                num = num.split('').reverse().join('').replace(/^[\.]/,'');
                return num
            } else {
                alert('Solo se permiten números');
            }
        }
    </script>
@stop