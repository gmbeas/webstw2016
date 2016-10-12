@extends('layouts.ventas.default')

@section('titulo', 'CiberMonday')

@section('css')

@stop

@section('content')
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <!-- BANNER CATEGORIA -->
    <div class="container">
        <section class="hidden-xs" id="resultBanner">
        </section>
    </div>
    <!-- END BANNER -->


    <section class="container">
        <!-- Options panel -->
        <div class="options-panel row">
            <div class="col-xs-6 col-md-4 col-lg-3 hidden-sm">
                <h3>PRECIO</h3>
                <div class="slider-range">
                    <div class="control"></div>
                    <div class="min">$<span class="value">1.000</span></div>
                    <div class="max">$<span class="value">45.000</span></div>
                </div>
            </div>
            <div class="clearfix visible-md visible-sm"></div>
            <div class="divider-xs visible-xs"></div>
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 hidden-xs">
                <h3>CATEGORIAS</h3>
                <div class="btn-group btn-select">
                    <select class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                        <option>Seleccione...</option>
                        @foreach($productos['_gruponivel'] as $grupo)
                            <option>{{$grupo['Nombre']}}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="divider-xs visible-sm"></div>
            <div class="col-sm-6 visible-sm">
                <h3>PRICE</h3>
                <div class="slider-range">
                    <div class="control"></div>
                    <div class="min">$<span class="value">19</span></div>
                    <div class="max">$<span class="value">3000</span></div>
                </div>
            </div>
        </div>
        <!-- //end Options panel -->


        <!-- Products list -->
        <div class="row products-list">
            @foreach($productos['_landing'] as $producto)
            <div class="product-preview ">
                <div class="preview animate scale">
                    <a href="{{ URL::to('/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html"
                       class="preview-image">
                        <img class="img-responsive animate scale"
                             src="{{URL::asset('/imagenweb/sku/' . $producto['Sku'])}}_b1.jpg" width="270"
                             height="328" alt="">
                    </a>
                    <ul class="product-controls-list right">
                        <li><span class="label label-sale">OFERTA</span></li>
                        @php
                            $diferencia = $producto['PrecioBrutoNormal'] - $producto['PrecioBruto'];
                            $porcentaje = 0;
                            if($diferencia <> 0){
                                $por = ($diferencia / $producto['PrecioBrutoNormal']);
                                $porcentaje = $por*100;
                            }

                        @endphp
                        <li><span class="label">-{{round($porcentaje)}}%</span></li>
                    </ul>

                </div>
                <h3 class="title"><a
                            href="{{ URL::to('/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html">{{$producto['NombreWeb']}}</a>
                </h3>

                <span class="price old">${{number_format($producto['PrecioBrutoNormal'], 0, ',', '.')}}</span>
                <span class="price new">${{number_format($producto['PrecioBruto'], 0, ',', '.')}}</span>
            </div>
            @endforeach




        </div>
        <!-- //end Products list -->
    </section>
@stop

@section('javascript')

@stop