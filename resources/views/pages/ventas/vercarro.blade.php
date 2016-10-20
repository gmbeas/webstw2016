@extends('layouts.ventas.default')

@section('titulo', 'Carro')

@section('content')
    @php
        $cart = new \Steward\Phpcart\Carrito('ventas');
        $totales = $cart->getBruto("0");
    @endphp
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <section class="container">
        <div class="row">
            <section class="col-md-8 col-lg-8" style="margin-top:40px">
                <!-- Shopping cart -->
                <section class="content-box">
                    <div class="shopping_cart">
                        <div class="bssssox">

                            @if($cart->count() > 0)
                            <h3>Carro de Compras</h3>
                            <table>
                                <thead>
                                <tr class="hidden-xs">
                                    <th></th>
                                    <th></th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart->getItems() as $producto)
                                <tr>
                                    <td>
                                        {{ Form::open(array('name' => 'formElimina_' . $producto->id, 'url' => 'carrito/' . $producto->id)) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        <a href="#" onclick="document.forms['formElimina_{{$producto->id}}'].submit(); return false;" class="remove-button hidden-xs">
                                            <span class="icon-cancel-2 "></span>
                                        </a>
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                        <a href="#" class="remove-button visible-xs">
                                            <span class="icon-cancel-2 "></span>
                                        </a>
                                        <a href="{{ URL::to('/ficha/' . $producto->id . '/' . Str::slug($producto->nombre, '-')) }}.html">
                                            <img class="preview" src="{{Asset::skus($producto->foto)}}">
                                        </a>
                                    </td>
                                    <td style="text-align:left">
                                        <span class="td-name visible-xs">Producto</span>
                                        <a href="{{ URL::to('/ficha/' . $producto->id . '/' . Str::slug($producto->nombre, '-')) }}.html" >{{$producto->nombre}}</a>
                                    </td>
                                    <td>
                                        <span class="td-name visible-xs">Precio</span>${{number_format($producto->precio, 0, ",", ".")}}
                                    </td>
                                    <td>
                                        <span class="td-name visible-xs">Cantidad</span>
                                        <div class="input-group quantity-control quantity-control-cart">
                                            <span class="input-group-addon">&minus;</span>
                                            <input type="text" data-unidad="{{$producto->unidad}}" data-key="{{$producto->id}}" data-defaultValue="{{$producto->cantidad}}" class="form-control" value="{{$producto->cantidad}}" rel="cantidadProducto">
                                            <span class="input-group-addon">+</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="td-name visible-xs">Total</span> <span rel="valor">${{number_format($producto->precio*$producto->cantidad , 0, ",", ".")}}</span>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                                <div class="row">
                                    <div class="col-md-4">
                                        <b class="title">Despacho:</b> a Calcular
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6 text-right" >
                                                <b>Neto:</b>
                                            </div>
                                            <div class="col-md-6 text-right" style="padding-right: 37px;">
                                                <span ><b id="neto">${{number_format($totales['neto'], 0, ",", ".")}}</b></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 text-right" >
                                                <b>Iva:</b>
                                            </div>
                                            <div class="col-md-6 text-right" style="padding-right: 37px;">
                                                <span ><b id="iva">${{number_format($totales['iva'], 0, ",", ".")}}</b></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 text-right" >
                                                <b>Total:</b>
                                            </div>
                                            <div class="col-md-6 text-right" style="padding-right: 37px;">
                                                <span><b id="total">${{number_format($totales['bruto'], 0, ",", ".")}}</b></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <hr>
                                        </div>
                                        <div class="row text-right">
                                            <div style="padding-right: 35px;" class="col-md-6 col-md-offset-6">
                                                <a href="{{URL::to('/checkout/0')}}" class="btn btn-mega">Comprar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <div class="clearfix"></div>
                            @endif
                        </div>
                    </div>
                </section>
                <!-- //end Shopping cart -->
            </section>
            <aside class="col-md-4 col-lg-4 shopping_cart-aside" style="margin-top:40px">
                <!-- Coupon -->
                <section class="container-widget">
                    <h3>Descuento</h3>
                    <form role="form">
                        <div class="form-group">
                            <label for="coupon">Ingresa tu codigo de descuento</label>
                            <input type="email" class="form-control input-sm" id="coupon">
                        </div>
                        <button type="submit" class="btn btn-mega">Aplicar Codigo</button>
                    </form>
                </section>
                <!-- //end Coupon -->
            </aside>
        </div>
    </section>

@stop


@section('javascript')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        function disminuirProducto(elemento) {
            var id = $(elemento).data('key'),
                    unidad = $(elemento).data('unidad');

            var cantidad = parseInt($(elemento).val()) - unidad;
            if (cantidad <= 0) {
                return false;
            }

            $.ajax({
                type: "POST",
                url: '{{URL::to('disminuirproducto')}}',
                data: {'id': id, 'cantidad': cantidad, 'unidad' : unidad, '_token' : token},
                success: function(response) {
                    var respuesta = JSON.parse(response);
                    $(elemento).val(cantidad).parents('tr').find('span[rel="valor"]').html('$'+$.formatNumber(respuesta.totalitem));
                    $('#neto').html('$'+$.formatNumber(respuesta.total.neto));
                    $('#iva').html('$'+$.formatNumber(respuesta.total.iva));
                    $('#total').html('$'+$.formatNumber(respuesta.total.bruto));
                    var target = $('[rel="carroFlotante"]');
                    if ($(target).length) {
                        $(target).html(respuesta.vista);
                    }
                }
            });

        }

        function incrementarProducto(elemento) {
            var id = $(elemento).data('key'),
                    unidad = $(elemento).data('unidad');

            var cantidad = parseInt($(elemento).val()) + unidad;

            $.ajax({
                type: "POST",
                url: '{{URL::to('incrementarproducto')}}',
                data: {'id': id, 'cantidad': cantidad, 'unidad' : unidad, '_token' : token},
                success: function(response) {
                    var respuesta = JSON.parse(response);
                    if (respuesta.estado) {
                        $(elemento).val(cantidad).parents('tr').find('span[rel="valor"]').html('$' + $.formatNumber(respuesta.totalitem));
                        $('#neto').html('$' + $.formatNumber(respuesta.total.neto));
                        $('#iva').html('$' + $.formatNumber(respuesta.total.iva));
                        $('#total').html('$' + $.formatNumber(respuesta.total.bruto));
                        var target = $('[rel="carroFlotante"]');
                        if ($(target).length) {
                            $(target).html(respuesta.vista);
                        }
                    } else {
                        swal(respuesta.mensaje);
                    }

                }
            });
        }
    </script>
@stop