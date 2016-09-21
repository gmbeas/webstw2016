@extends('layouts.ventas.default')

@section('titulo', 'Categoría')

@section('styles')
    <style>
        .glyphicon-spin {
            -webkit-animation: spin 1000ms infinite linear;
            animation: spin 1000ms infinite linear;
        }
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(359deg);
                transform: rotate(359deg);
            }
        }
        @keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(359deg);
                transform: rotate(359deg);
            }
        }
        a.prefijo, #lista-lineas a.linea {
            font-weight: normal;
        }
        a.prefijo.activo, #lista-lineas a.linea.activo {
            font-weight: bold;
        }
        #recogerCategorias, #lineasTodas {
            outline: none;
        }
        #lista-categorias > li.categorias > span.name {
            font-size: 1.1em;
            background-color: #eee;
            padding-left: 3px;
            border-bottom: 1px solid #fff;
        }
        #lista-categorias > li.categorias > ul > li {
            font-size: 0.9em;
        }
    </style>
@stop

@section('content')


    <!-- BANNER CATEGORIA -->
    <div class="container">
        <section class="hidden-xs" id="resultBanner">
            <img src="{{URL::asset('/imagenweb/arbol/' . $productos['_productos'][0]['FotoArbol'])  }}" alt=""
                 width="100%">
        </section>
    </div>
    <!-- END BANNER -->


    <section class="container">
        <div class="row">
            <!-- BREADCRUMB -->

            <!-- END  -->

            <!-- SLIDE LEFT -->
            <aside class="col-sm-4 col-md-3 col-lg-3 content-aside" style="padding-top: 0px;padding-bottom: 0px;">

                <div class="section-divider"></div>

                <div class="section-divider"></div>

            </aside>
            <!-- END SLIDE -->
            <section class="col-sm-8 col-md-9 col-lg-9 content-center">
                <div class="section-divider" style="padding-top: 0px;padding-bottom: 0px;"></div>
                <h3 id="TituloPrefijo">{{$nombre}}</h3>
                <!-- BOX CATEGORIAS -->

                <div class="well well-xs">
                    <div class="row">

                    </div>
                </div>

                <!-- END BOX -->
                <div class="products-list row" id="resultLineas" style="display: none;"></div>
                <div class="products-list" id="resultProductos"
                     data-categoria=""
                     data-tipo=""
                     data-arbol="">
                    @foreach($productos['_productos'] as $producto)

                        <div class="product-preview">
                            <div class="preview ">
                                <a href="{{ URL::to('/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html"
                                   class="preview-image">
                                    <img class="bordegris"
                                         src="{{URL::asset('/imagenweb/sku/' . trim($producto['Sku']) .'_b1.jpg' )}}"
                                         width="270" height="270" alt="">
                                </a>
                                <ul class="product-controls-list right hide-right">
                                    <li class="top-out-small"></li>
                                </ul>
                            </div>
                            <h3 class="title nombreProducto">
                                <a href="{{ URL::to('/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html"
                                   class="preview-image">
                                    {{$producto['NombreWeb']}}
                                </a>
                            </h3>
                            <span class="price new">${{number_format($producto['PrecioBruto'], 0, ",", ".")}}</span>
                            <!--description-->
                            <div class="list_description">{{$producto['NombreWeb']}}</div>
                            <div class="nombreBusqueda hidden">{{strtolower($producto['NombreSku'])}}</div>
                            <!--buttons-->
                            <div class="list_buttons">
                                <a class="btn btn-mega pull-left" href="#">
                                    Add to Cart
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </section>
        </div>

    </section>

@stop

@section('scripts')


@stop