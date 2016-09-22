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
                                <input type="radio" name="mediopago" id="mediopago" value="1" checked="checked" style="margin-right: 10px;"> Web Play Plus
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
                                                        {{Form::checkbox('politicas', 'value', false, ['id' => 'politicas'])}}
                                                        <a href="" target="_blank" style="margin-left: 7px;">acepto los términos y condiciones</a>
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
                </div>
                <!-- end check out -->
                <div class="divider divider-sm visible-sm  visible-xs"></div>
            </div>
        </div>
    </div>

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
                    $('#valorDespacho').html ('$'+format(respuesta.total.flete)+' + IVA');
                    $('#valorDespacho2').html ('$'+format(respuesta.total.flete)+' + IVA');
                    $('#precioTotal').html ('$'+format(respuesta.total.bruto));
                    $('#iva').html ('$'+format(respuesta.total.iva));
                    $('#neto').html ('$'+format(respuesta.total.neto));
                }
            });
        }





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


        $('#CompraDespachoId').change(function() {
            var id = $(this).val();
            cambiarDespacho(id);
        });

        function format(input) {
            var num = input;
            if(!isNaN(num)) {
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                num = num.split('').reverse().join('').replace(/^[\.]/,'');
                return num
            } else {
                alert('Solo se permiten numeros');
            }
        }
    </script>
@stop