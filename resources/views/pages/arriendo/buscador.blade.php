@extends('layouts.arriendo.default')

@section('titulo', 'Buscador')

@section('styles')
    <style>

    </style>
@stop

@section('content')

    <section class="container">
        <div class="row">
            <!-- BREADCRUMB -->
            <div class="col-md-12">
                <ol class="breadcrumb no-margin">
                    <li><a href="{{URL::to('arriendo/')}}">Ventas</a></li>
                    <!-- <li><a href="#">Library</a></li> -->
                    <li class="active">Búsqueda &raquo; <small style="text-decoration: underline;">{{$palabra}}</small></li>
                </ol>
            </div>
            <!-- END  -->
            <!-- SLIDE LEFT -->
            <aside class="col-sm-4 col-md-3 col-lg-3 content-aside" style="padding-top: 0px;padding-bottom: 0px;">

                <div class="section-divider"></div>

                <div class="section-divider"></div>
            </aside>
            <!-- END SLIDE -->

            <section class="col-sm-8 col-md-9 col-lg-9 content-center">
                <div class="section-divider" style="padding-top: 0px;padding-bottom: 0px;"></div>
                <h3>Resultado de búsqueda: </h3>
                <h4>{{$palabra}}</h4>
                <hr>
                <div class="products-list row">

                    @foreach($productos['_skus'] as $producto)
                        <div class="product-preview">
                            <div class="preview ">
                                <a href="{{ URL::to('/arriendo/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html" class="preview-image">
                                    <img class="bordegris" src="{{URL::asset('/imagenweb/sku/' . trim($producto['Sku']) .'_b1.jpg' )}}" width="270" height="270" alt="">
                                </a>
                                <ul class="product-controls-list right hide-right">
                                    <li class="top-out-small"></li>
                                </ul>
                            </div>
                            <h3 class="title nombreProducto">
                                <a href="{{ URL::to('/arriendo/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html" class="preview-image">{{$producto['NombreWeb']}}</a>
                            </h3>
                            <span class="price new">
                                @php
                                    $precio = 0;
                                if ($producto['PrecioUnidad'])
                                {
                                    $precio = number_format($producto['PrecioUnidad'], 0, ",", ".");
                                }
                                else
                                {
                                    if ($producto['Precio'])
                                    {
                                        $precio = number_format($producto['Precio'], 0, ",", ".");
                                    }
                                    if ($producto['Um'] != 'CU')
                                    {
                                        $precio.= ' ' . $producto['Um'];
                                    }
                                }
                                echo '$' . $precio;
                                @endphp
                            </span><!--rating-->
                            <!--description-->
                            <div class="list_description">{{$producto['NombreWeb']}}</div>
                            <div class="nombreBusqueda hidden">{{$producto['NombreSku']}}</div>
                            <!--buttons-->
                            <div class="list_buttons"> <a class="btn btn-mega pull-left" href="#">Add to Cart</a></div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

    </section>


@stop

@section('scripts')


@stop