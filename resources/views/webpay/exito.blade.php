@extends('layouts.ventas.default')
@section('titulo', 'Venta Finalizada')

@section('css')

@stop

@php

        @endphp

@section('content')
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <section class="container">
        <br>
        <div style="color: #FFF; position: relative; text-align: right; top: 90px; margin-right: 15px; z-index: 999;">
            <a href="" class="btn btn-default btn-mega"><span class="glyphicon glyphicon-chevron-left"></span>
                Volver</a>

            <a href="#" class="btn btn-default btn-mega" rel="btnImprimir"><span
                        class="glyphicon glyphicon-print"></span> Imprimir</a>
        </div>
        <div id="exportable" class="col-md-12" rel="printZone">
            <h3>Gracias por su compra</h3>
            <p><b>Estimado </b></p>
            <p>Su compra a finalizado exitosamente.</p>

            <div class="row">
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Sus datos</b>
                        </div>
                        <table id="datos" class="table table-condensed table-hover">
                            <tr>
                                <td>
                                    <small>NOMBRE</small>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>RUT</small>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>TELÉFONO</small>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>EMAIL</small>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Datos de despacho</b>
                        </div>
                        <table class="table table-condensed table-hover">
                            <tr>
                                <td>
                                    <small>DIRECCIÓN</small>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>COMUNA</small>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>REGIÓN</small>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>TELEFONO</small>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>EMAIL</small>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Datos del pago</b>
                        </div>
                        <table class="table table-condensed table-hover">
                            <tr>
                                <td>
                                    <small>N° DE TARJETA</small>
                                </td>
                                <td>XXXX - XXXX - XXXX -</td>
                            </tr>
                            <tr>
                                <td>
                                    <small>N° DE TRANSACCIÓN</small>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>TIPO DE TRANSACCIÓN</small>
                                </td>
                                <td>Venta</td>
                            </tr>

                            <tr>
                                <td>
                                    <small>TIPO DE PAGO</small>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>TIPO DE CUOTAS</small>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>CUOTAS</small>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>CÓDIGO DE AUTORIZACIÓN</small>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>FECHA</small>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>HORA</small>
                                </td>
                                <td></td>
                            </tr>
                            <tr class="hidden">
                                <td>
                                    <small>POLITICAS DE SERVICIO</small>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-xs" onclick="alert('Descargar pdf');">
                                        <i class="glyphicon glyphicon-download-alt"></i> politicas de servicio.pdf
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Productos comprados</b>
                        </div>

                        <table class="table table-condensed table-hover">
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


                            <tr>
                                <td colspan="5"></td>
                            </tr>

                            <tr>
                                <td colspan="3" class="col-xs-9 text-right" style="border-top: 0;">
                                    <small>DESPACHO</small>
                                </td>
                                <td class="text-right" style="border-top: 0;">$</td>
                                <td class="col-xs-3 text-right" style="border-top: 0;"></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="col-xs-9 text-right" style="border-top: 0;">
                                    <small>NETO</small>
                                </td>
                                <td class="text-right" style="border-top: 0;">$</td>
                                <td class="col-xs-3 text-right" style="border-top: 0;"></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="col-xs-9 text-right" style="border-top: 0;">
                                    <small>IVA</small>
                                </td>
                                <td class="text-right" style="border-top: 0;">$</td>
                                <td class="col-xs-3 text-right" style="border-top: 0;"></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="col-xs-9 text-right" style="border-top: 0;">
                                    <small>TOTAL</small>
                                </td>
                                <td class="text-right" style="border-top: 0;">$</td>
                                <td class="col-xs-3 text-right" style="border-top: 0;"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-offset-6 col-md-6" style="margin-bottom: 20px; color: #FFF; text-align: right;">
            <a href="" class="btn btn-default btn-mega"><span class="glyphicon glyphicon-chevron-left"></span>
                Volver</a>

            <a href="#" class="btn btn-default btn-mega" rel="btnImprimir"><span
                        class="glyphicon glyphicon-print"></span> Imprimir</a>
        </div>
    </section>

@stop


@section('javascript')

    <script>
        var token = $('meta[name="csrf-token"]').attr('content');

    </script>
@stop