@extends('layouts.ventas.default')
@section('titulo', 'Checkout')

@section('css')
@stop

@php

@endphp

@section('content')
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

                </div>
                <!-- end check out -->
                <div class="divider divider-sm visible-sm  visible-xs"></div>
            </div>
        </div>
    </div>

@stop


@section('javascript')
    <script>
        $('#CompraDespachoId').change(function() {
            var id = $(this).val();
            console.log(id);
        });
    </script>
@stop