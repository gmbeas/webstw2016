@extends('layouts.arriendo.default')

@section('titulo', 'Combo')

@section('css')
    <style>
        .steward-font-color {
            color: #E65C01 !important;
        }

        .listado-combos li {
            /*float: left;*/
        }

        .listado-combos li a {
            padding: 10px;
            display: block;
            border-bottom-width: 1px;
            border-bottom-style: dotted;
            border-bottom-color: #E2E1E0;
            overflow: hidden;
        }

        .listado-combos li a:hover {
            background: #fee8d0;
            text-decoration: none !important;
        }

        .listado-combos li a img {
            float: left;
            width: 50px;
            height: 70px;
        }

        .listado-combos li a h5 {
            font-size: 14px;
            margin-top: 0px;
            padding-bottom: 0px;
            font-weight: 900;
            color: #5a5a5a;
        }

        .listado-combos li a p {
            margin-bottom: 0px;

        }

        .listado-combos li a h5, .listado-combos li a p {
            margin-left: 60px;
        }

        .listado-combos li a.active {
            background: #fee8d0;
        }

        .listado-combos li a.active h5 {
            color: #973800;

        }

        .listado-combos li a.active p {
            color: #973800;
        }

        .listado-combos li:last-child a {
            border: none;
        }

        .title-combos {
            margin-top: 20px;
            margin-bottom: 10px;
            margin-left: 10px;
            padding-bottom: 0px;
            font-weight: normal;
        }

        .title-combos-detalle {
            background: #E65C01;
            color: #fff !important;
            padding: 10px;
            font-weight: normal;
        }

        .listado-combo-detalle {

        }

        .listado-combo-detalle li {
            display: block;
            clear: left;

        }

        .listado-combo-detalle li .numero {
            -webkit-border-radius: 40px 40px 40px 40px;
            border-radius: 40px 40px 40px 40px;
            background: #E65C01;
            color: #fff !important;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 18px;
            padding-bottom: 10px;
            text-align: center;
            float: left;
            font-size: 20px;
            font-weight: normal;
            width: 50px;
            height: 50px;
            margin-top: 30px;
            margin-bottom: 20px;
            margin-left: 20px;
            margin-right: 20px;
        }

        .listado-combo-detalle li .divisor {
            padding-bottom: 50px;
            padding-top: 30px;
            display: block;
            border-top-width: 1px;
            border-top-style: solid;
            border-top-color: #CCC;
            margin-left: 100px;
            margin-right: 100px;
        }

        .listado-combo-detalle li .divisor h6 {
            font-size: 11 !important;
            color: #565656;
            text-transform: none;
            margin-top: 13px;
        }

        .listado-combo-detalle li .divisor img {
            width: 50px;
            height: 50px;
            background: #EFEFEF;
            float: left;
            overflow: hidden;
            margin-right: 20px;
        }

        .listado-combo-detalle li .borrar {
            float: right;
            -webkit-border-radius: 40px 40px 40px 40px;
            border-radius: 40px 40px 40px 40px;
            background: #E65C01;
            padding-top: 8px;
            padding-bottom: 10px;
            padding-left: 13px;
            padding-right: 13px;
            text-align: center;
            font-weight: normal;
            margin-top: 40px;
        }

        .listado-combo-detalle li .borrar a {
            color: #fff;
            font-size: 17px;
        }

        .titulo-combo-detalle {
            margin-left: 100px;
        }

        .cantidad-combo-detalle {
            width: 70px;
            margin-top: 40px;
            margin-right: 60px;
        }
    </style>
@stop

@section('content')
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <div id="modalLoadning" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content"
                 style="background-color: rgba(255,255,255,0); border: 0; -webkit-box-shadow: none; box-shadow: none;position: absolute; margin-top: 30%; width: 100%; color: #ccc;">
                <div class="modal-body text-center">
                    <img src="{{URL::asset('/img/loading.gif')}}" height="80"/>
                    <!-- <p>cargando... </p><p>por favor espere</p> -->
                </div>
            </div>
        </div>
    </div>

    <!-- BANNER CATEGORIA -->
    <div class="container">
        <section class="hidden-xs">
            <img src="{{URL::asset('/img/combos.jpg')}}" alt="" width="100%">
        </section>
    </div>
    <!-- END BANNER -->
    <section class="container">
        <div class="row">
            <!-- BREADCRUMB -->
            <div class="col-md-12">
                <ol class="breadcrumb no-margin">
                    <li><a href="">Arriendo</a></li>
                    <li><a href="">Decoración Temática</a></li>
                    <li class="active">{{$productos['_info']['NombreCombo']}}</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="row">
            <div class="col-md-3">
                <h3 class="title-combos">Decoración Temática</h3>
                <ul class="listado-combos list-unstyled">
                    @foreach($combos['_combos'] as $combo)
                        <li>
                            <a href="{{URL::to('arriendo/detallecombo/' . $combo['Cbo_Id'] . '/' . $combo['Mod_Id'] . '/' . $combo['NroInvitados'] . '/' . Str::slug($combo['Combo']))}}.html"
                               class="{{Request::segment(3) == $combo['Cbo_Id'] && Request::segment(4) == $combo['Mod_Id'] ? 'active' : ''}}">
                                <img src="{{URL::asset('/imagenweb/otro/' . trim($combo['NombreImagen2']))}}" alt="">
                                <h5>{{$combo['Combo']}}</h5>
                                <p></p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-9">


                <div class="row" style="margin-top:30px">
                    <div class="col-md-12">
                        <img src="{{URL::asset('/imagenweb/otro/' . $productos['_info']['NombreImagen'])}}"
                             width="100%">
                    </div>
                </div>

                {{ Form::open(array('url' => '/arriendo/agregacombo', 'class' => 'validar-formulario', 'id' => 'comboForm')) }}
                {{ Form::hidden('_method', 'POST') }}
                <div class="row" style="margin-top:30px;margin-bottom:30px">
                    <div class="col-md-6">
                        <h4 class="title-combos-detalle">
                            {{$productos['_info']['NombreCombo']}}
                        </h4>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-top:10px">
                            <label for="input" class="col-sm-9 control-label"><h5 class="steward-font-color">Número de
                                    invitados:</h5></label>

                            <div class="input-group col-sm-3" style="margin-top:-5px">
                                {{ Form::input('number', 'data[Combo][invitados]', $productos['_info']['NroInvitados'], ['class' => 'form-control', 'id' => 'ComboInvitados', 'min' => '1']) }}
                                <div class="input-group-addon" id="refresh-combo"><span
                                            class="glyphicon glyphicon-refresh"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="listadoProductos">
                        @php($cont = 0)
                        @foreach($productos['_simula'] as $producto)
                            <h4 class="titulo-combo-detalle steward-font-color">{{$producto['Nombre']}}</h4>
                            <ul class="listado-combo-detalle list-unstyled">
                                @foreach($producto['_skus'] as $sku)
                                    @php(++$cont)
                                    <li>
                                        <span class="borrar" style="background: none; margin-top: 30px;">

                                            <a href="#" rel="borrarProducto" class="btn btn-default btn-mega"
                                               style="font-size: .8em;">
                                                eliminar
                                            </a>

                                        </span>

                                        <div class="cantidad-combo-detalle pull-right text-right"
                                             style="margin-top: 45px;">
                                            ${{number_format($sku['ValorBruto'], 0, ",", ".")}}
                                        </div>

                                        <div class="cantidad-combo-detalle pull-right">
                                            {{ Form::hidden('data[Producto][' . $cont . '][id]', $sku['Sku_Id']) }}
                                            {{ Form::hidden('data[Producto][' . $cont . '][sku]', $sku['Sku']) }}
                                            {{ Form::hidden('data[Producto][' . $cont . '][precio]', $sku['PrecioUn']) }}
                                            {{ Form::hidden('data[Producto][' . $cont . '][nombre]', $sku['NombreWeb']) }}
                                            {{ Form::hidden('data[Producto][' . $cont . '][unidad]', $sku['Unidades']) }}
                                            {{ Form::hidden('data[Producto][' . $cont . '][bruto]', $sku['ValorBruto']) }}
                                            {{ Form::hidden('data[Producto][' . $cont . '][foto]', $sku['Sku'] . '_b1.jpg') }}

                                            {{ Form::input('number', 'data[Producto][' . $cont . '][cantidad]', $sku['Unidades'], ['class' => 'form-control', 'id' => 'Producto' . $cont . 'Cantidad', 'min' => '1']) }}
                                        </div>
                                        <span class="numero">{{$cont}}</span>
                                        <span class="divisor">
                                            <a href="{{ URL::to('/arriendo/ficha/' . $sku['Sku']. '/' . Str::slug($sku['NombreWeb'], '-')) }}.html"><img
                                                        src="{{URL::asset('/imagenweb/sku/' . $sku['Sku'])}}_b1.jpg"
                                                        alt=""></a>
                                            <a href="{{ URL::to('/arriendo/ficha/' . $sku['Sku']. '/' . Str::slug($sku['NombreWeb'], '-')) }}.html"><h6>{{$sku['NombreWeb']}}</h6></a>
                                        </span>
                                    </li>
                                @endforeach

                            </ul>
                        @endforeach
                    </div>
                </div>
                <div class="row" style="margin-bottom:30px">
                    <div class="col-md-4 col-md-offset-8">
                        <a href="#" class="btn btn-mega btn-block" rel="agregarCombo">
                            Enviar cotización
                        </a>
                    </div>
                </div>
                {{Form::close()}}

            </div>
        </div>
    </section>
@stop

@section('javascript')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {
            $(document).on('click', '#comboForm .borrar a[rel="borrarProducto"]', function (e) {
                e.preventDefault();
                var contenedor = $(this).parents('li');
                var padre = $(contenedor).parents('ul');

                var numero = contenedor.find('.numero');
                var titulo = contenedor.find('.divisor h6');
                var cantidad = contenedor.find('.cantidad-combo-detalle  .form-control');
                var precio = contenedor.find('div.cantidad-combo-detalle.pull-right.text-right');


                if ($(this).html().toLowerCase().trim() == "eliminar") {

                    $(numero).css('text-decoration', 'line-through');
                    $(titulo).css('text-decoration', 'line-through');
                    $(cantidad).prop('readonly', true);
                    $(precio).css('text-decoration', 'line-through');
                    $(this).html("AGREGAR");
                } else {

                    $(this).html("ELIMINAR");
                    $(numero).css('text-decoration', 'none');
                    $(titulo).css('text-decoration', 'none');
                    $(cantidad).prop('readonly', false);
                    $(precio).css('text-decoration', 'none');
                }

            });

            var requestCombo;
            // $('#comboForm #ComboInvitados').change(function(e) {
            $('#comboForm #refresh-combo').click(function (e) {
                var invitados = $(this).val(),
                        formulario = $(this).parents('form');
                if (isNaN(invitados)) {
                    $.alerta('La cantidad de personas no es un valor númerico.');
                    return false;
                }
                var target = $('#comboForm #listadoProductos');
                if (!$(target).length) {
                    return false;
                }

                if ($('#modalLoadning').length) {
                    $('#modalLoadning').modal({backdrop: 'static', show: true});
                }

                if (requestCombo)
                    requestCombo.abort();


                requestCombo = $.ajax({
                    async: true,
                    dataType: "json",
                    type: 'POST',
                    url: '{{URL::to('arriendo/carganuevocombo')}}',
                    data: {
                        'cbo': '{{Request::segment(3)}}',
                        'mod': '{{Request::segment(4)}}',
                        'inv': $('#ComboInvitados').val(),
                        '_token': token
                    },
                    success: function (respuesta) {
                        //var respuesta = JSON.parse(response);
                        $(target).html('');
                        var cont = 0;
                        $.each(respuesta._simula, function (grupo, productos) {

                            var combosHtml = '<h4 class="titulo-combo-detalle steward-font-color">' + productos.Nombre + '</h4><ul class="listado-combo-detalle list-unstyled">';
                            $.each(productos._skus, function (index, producto) {
                                ++cont;
                                //console.log(producto)
                                var urlfoto = '{{URL::asset('/imagenweb/sku/')}}';
                                var urllink = '{{ URL::to('/arriendo/ficha/')}}';
                                var url = urllink + '/' + $.trim(producto.Sku) + '/' + producto.Url;
                                var foto = urlfoto + '/' + $.trim(producto.Sku) + '_b1.jpg';
                                combosHtml += '<li>' +
                                        '<span class="borrar" style="background: none; margin-top: 30px;"><a href="#" rel="borrarProducto" class="btn btn-default btn-mega" style="font-size: .8em;">eliminar</a></span><div class="cantidad-combo-detalle pull-right text-right" style="margin-top: 45px;">$' + number_format(producto.ValorBruto, 0, ',', '.') + '</div><div class="cantidad-combo-detalle pull-right">' +
                                        '<input type="hidden" name="data[Producto][' + cont + '][id]" value="' + $.trim(producto.Sku_Id) + '" id="Producto' + cont + 'Id">' +
                                        '<input type="hidden" name="data[Producto][' + cont + '][sku]" value="' + $.trim(producto.Sku) + '" id="Producto' + cont + 'Sku">' +
                                        '<input type="hidden" name="data[Producto][' + cont + '][precio]" value="' + $.trim(producto.PrecioUn) + '" id="Producto' + cont + 'Precio">' +
                                        '<input type="hidden" name="data[Producto][' + cont + '][nombre]" value="' + $.trim(producto.NombreWeb) + '" id="Producto' + cont + 'Nombre">' +
                                        '<input type="hidden" name="data[Producto][' + cont + '][unidad]" value="' + $.trim(producto.Unidades) + '" id="Producto1Unidad">' +
                                        '<input type="hidden" name="data[Producto][' + cont + '][foto]" value="' + $.trim(producto.Sku) + '_b1.jpg" id="Producto1Foto">' +
                                        '<input name="data[Producto][' + cont + '][cantidad]" class="form-control" value="' + $.trim(producto.Unidades) + '" min="1" type="number" id="Producto' + cont + 'Cantidad">' +
                                        '</div>' +
                                        '<span class="numero">' + cont + '</span><span class="divisor">' +
                                        '<a href="' + url + '"><img src="' + foto + '" alt="' + $.trim(producto.Sku) + '_b1.jpg"></a>' +
                                        '<a href="' + url + '"><h6>' + $.trim(producto.NombreWeb) + '</h6></a>' +
                                        '</span>' +
                                        '</li>';
                            });

                            combosHtml += '</ul>';
                            $(target).append(combosHtml);
                        });
                    },
                    error: function () {
                        $.alerta('Se ha producido un problema al intentar cargar el combo. Por favor intentelo nuevamente.');
                    },
                    complete: function () {
                        if ($('#modalLoadning').length) {
                            setTimeout(function () {
                                $('#modalLoadning').modal('hide');
                            }, 500);
                        }
                    }
                });


                return false;
            });

            $(document).on('click', '#comboForm a[rel="agregarCombo"]', function (e) {
                e.preventDefault();
                $(this).parents('form').submit();
            });

            function number_format(number, decimals, decPoint, thousandsSep) {
                decimals = decimals || 0;
                number = parseFloat(number);

                if (!decPoint || !thousandsSep) {
                    decPoint = '.';
                    thousandsSep = ',';
                }

                var roundedNumber = Math.round(Math.abs(number) * ('1e' + decimals)) + '';
                var numbersString = decimals ? roundedNumber.slice(0, decimals * -1) : roundedNumber;
                var decimalsString = decimals ? roundedNumber.slice(decimals * -1) : '';
                var formattedNumber = "";

                while (numbersString.length > 3) {
                    formattedNumber += thousandsSep + numbersString.slice(-3)
                    numbersString = numbersString.slice(0, -3);
                }

                return (number < 0 ? '-' : '') + numbersString + formattedNumber + (decimalsString ? (decPoint + decimalsString) : '');
            }
        });
    </script>
@stop