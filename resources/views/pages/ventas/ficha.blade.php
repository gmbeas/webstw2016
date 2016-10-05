@extends('layouts.ventas.default')

@section('titulo', 'Ficha')

@section('content')

    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <div class="container">
        <div class="row" style="margin-bottom: 40px;">

        </div>
        <div class="product-view row">
            <div class="col-sm-6 col-md-5 col-lg-5">
                <div class="large-image">
                    <img alt="#" class="cloudzoom hidden-xs hidden-sm" src="{{URL::asset('/imagenweb/sku/' . $producto['foto'][0])}}" data-cloudzoom = "zoomImage: '{{URL::asset('/imagenweb/sku/' . $producto['foto'][0])}}', autoInside : 900, zoomSizeMode: 'image'" />
                    <img alt="#" class="cloudzoom mobile-cloudzoom hidden-md hidden-lg" src="{{URL::asset('/imagenweb/sku/' . $producto['foto'][0])}}" data-cloudzoom = "zoomImage: '{{URL::asset('/imagenweb/sku/' . $producto['foto'][0])}}'" />
                </div>

                <!-- GALERIA -->
                <div id="galeria" class="flexslider flexslider-thumb" style="max-width: 100%;">
                    <div class="flex-viewport" style="overflow: hidden; position: relative;">
                        <ul class="previews-list slides" style="width: 1000%; -webkit-transition-duration: 0s; transition-duration: 0s; -webkit-transform: translate3d(0px, 0px, 0px);">
                            @foreach($producto['foto'] as $imagen)
                                <li style="width: 76px; float: left; display: block;">
                                    <img class="cloudzoom-gallery hidden-xs hidden-sm" alt="#" src="{{URL::asset('/imagenweb/sku/' . $imagen)}}" data-cloudzoom="useZoom: '.cloudzoom', image: '{{URL::asset('/imagenweb/sku/' . $imagen)}}', zoomImage: '{{URL::asset('/imagenweb/sku/' . $imagen)}}', autoInside : 991" draggable="false">
                                    <img class="cloudzoom-gallery hidden-md hidden-lg" alt="#" src="{{URL::asset('/imagenweb/sku/' . $imagen)}}" data-cloudzoom="useZoom: '.mobile-cloudzoom', image: '{{URL::asset('/imagenweb/sku/' . $imagen)}}'" draggable="false">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <ul class="flex-direction-nav">
                        <li>
                            <a class="flex-prev flex-disabled" href="#" tabindex="-1"></a>
                        </li>
                        <li>
                            <a class="flex-next" href="#"></a>
                        </li>
                    </ul>
                </div>
                <!-- FIN GALERIA -->
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="product-label">
                    <h2>{{$producto['prefijo']}}</h2>
                    @if($producto['unidad_venta'] == 1)
                        <span class="price" style="color: #c00232; margin: 0;">${{number_format($producto['precio'], 0, ",", ".")}}</span>
                        <p style="font-weight: 600; margin-left: .2em;">Incluye I.V.A.</p>
                    @else
                        <span class="price new" style="margin: 0;">${{number_format($producto['precio'], 0, ",", ".")}} <small> x {{$producto['unidad_venta']}} Unid</small></span>
                        <p style="font-weight: 600; margin-left: .2em;">Incluye I.V.A.</p>
                        <span class="price unit">Precio unitario : ${{number_format($producto['precio_unitario'], 0, ",", ".")}} Incluye I.V.A.</span>
                    @endif
                </div>
                <div class="product-description">
                    <form>
                        <div class="option"> <b>Cantidad:</b>
                            <div class="input-group quantity-control quantity-control-cart">
                                <span class="input-group-addon">&minus;</span>
                                <input type="text" name="cantidad" id="cantidad"
                                       data-unidad="{{$producto['unidad_venta']}}" data-key="{{$producto['codigo']}}"
                                       data-defaultValue="{{$producto['unidad_venta']}}" class="form-control"
                                       value="{{$producto['unidad_venta']}}" rel="cantidadProducto">
                                <span class="input-group-addon">+</span>
                            </div>


                        </div>
                        <div class="clearfix visible-xs"></div>
                        <a class="btn btn-mega btn-lg" id="comprar" >COMPRAR</a>
                    </form>
                    <!-- BOTON DE ARRIENDO -->
                    @if(isset($producto['disponible']['arriendo']) && $producto['disponible']['arriendo'])
                        <div class="row" style="margin-bottom:20px;">
                            <a href="{{URL::to('/arriendo/ficha/' . $producto['codigo'] . '/' . Str::slug($producto['NombreWeb']))}}.html"
                               class="btn btn-warning btn-lg pull-left btn-arriendo">DISPONIBLE EN ARRIENDO</a>
                        </div>
                    @endif
                    <!-- FIN -->

                    <div class="row">
                        <div class="panel panel-descripcion">
                            <div class="panel-heading">
                                Descripción
                            </div>
                            <div class="panel-body">
                                <p>sku: {{$producto['codigo']}}</p>
                                @foreach($producto['caracteristicas'] as  $caracteristica)
                                    <p>{{$caracteristica}}</p>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <section class="col-sm-12 col-md-3 col-lg-3">
               <!-- relacionados -->
            </section>
        </div>
        <!-- tipos -->
    </div>
    <style>
        #modal-add-cart .btn-mega.btn-default {
            border-color: #c00232;
            background-color: #FFF;
            color: #c00232 !important;
        }
        #modal-add-cart .btn-mega.btn-default:hover {
            border-color: #ee3b27;
            background-color: #EEE;
            color: #ee3b27 !important;
        }
    </style>

    <div id="modal-add-cart" class="modal fade" style="top: 10%; outline: none;" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Atención:</h4>
                </div>
                <div class="modal-body">Su producto ha sido agregado al carro.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-mega btn-danger" data-dismiss="modal">Continuar</button>
                    <a href="{{URL::to('/carrito')}}" class="btn btn-mega btn-default">Ir al carro</a>
                </div>
            </div>
        </div>
    </div>

@stop


@section('javascript')
    <script>

        var token = $('meta[name="csrf-token"]').attr('content');

        function verificaCantidad() {
            //swal("Debe seleccionar una cantidad.", "You clicked the button!", "info")
            var cantidad = $('#cantidad').val();
            var unidad = $('#cantidad').data('unidad');
            if (! cantidad) {
                //$.alerta('Debe seleccionar una cantidad.');
                swal("Debe seleccionar una cantidad.", "", "info")
                return false;
            }
            if (! unidad) {
                unidad = 1;
            }
            if ( (cantidad % unidad) ) {
                //$.alerta('Este producto se vende en set de '+unidad+'. Por favor seleccione un multiplo de '+unidad+'.');

                swal('Este producto se vende en set de ' + unidad + '. Por favor seleccione un multiplo de ' + unidad + '.', "", "info")
                return false;
            }
            return true;
        }
        $(document).ready(function(){
            $('#comprar').click(function() {
                var sku = '{{trim($producto['codigo'])}}';
                var cantidad = $('#cantidad').val();
                var nombre = '{{trim($producto['NombreWeb'])}}';
                var precio = '{{$producto['precio_unitario']}}';
                var foto = '{{$producto['foto'][0]}}';
                var unidad = '{{$producto['unidad_venta']}}';
                var skuid = '{{$producto['skuid']}}'
                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: "POST",
                    url: '{{URL::to('addcarro')}}',
                    data: {'sku': sku, 'cantidad': cantidad, 'nombre' : nombre, 'precio' : precio, 'foto' : foto, 'unidad' : unidad, 'skuid' : skuid, '_token' : token},
                    success: function(response) {
                        var respuesta = JSON.parse(response);
                        if (respuesta.estado == 'OK') {
                            $('#modal-add-cart .modal-body').html('<span class="glyphicon glyphicon-ok-sign"></span> '+respuesta.mensaje);
                            $('#modal-add-cart').modal('show');
                            var target = $('[rel="carroFlotante"]');
                            if ($(target).length) {
                                $(target).html(respuesta.vista);
                            }
                        } else {
                            swal(respuesta.mensaje);
                        }
                    }
                });
            });
        });

        $('#cantidad').change(function() {
            if (! verificaCantidad() ) {
                return false;
            }
        });

        function disminuirProducto(elemento) {
            var id = $(elemento).data('key'),
                    unidad = $(elemento).data('unidad');

            var cantidad = parseInt($(elemento).val()) - unidad;
            if (cantidad <= 0) {
                return false;
            }
            $(elemento).val(cantidad).parents('tr').find('span[rel="valor"]').html('$' + $.formatNumber(cantidad));
        }

        function incrementarProducto(elemento) {
            var id = $(elemento).data('key'),
                    unidad = $(elemento).data('unidad');

            var cantidad = parseInt($(elemento).val()) + unidad;

            $.ajax({
                type: "POST",
                url: '{{URL::to('/incrementarproductoFicha')}}',
                data: {'id': id, 'cantidad': cantidad, 'unidad': unidad, '_token': token},
                success: function (response) {
                    var respuesta = JSON.parse(response);
                    //console.log(respuesta);
                    //$(elemento).val(cantidad).parents('tr').find('span[rel="valor"]').html('$'+$.formatNumber(cantidad));
                    if (respuesta._stock.Flag == 1) {
                        $(elemento).val(cantidad).parents('tr').find('span[rel="valor"]').html('$' + $.formatNumber(cantidad));
                    }
                    else {
                        swal(respuesta._stock.Mensaje);
                    }
                }
            });
        }


    </script>
@stop