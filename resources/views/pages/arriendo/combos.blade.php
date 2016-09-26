@extends('layouts.arriendo.default')

@section('titulo', 'Ficha')

@section('css')

@stop

@section('content')

    <meta name="csrf-token" content="{!! csrf_token() !!}">


    <!-- BANNER CATEGORIA -->
    <div class="container">
        <section class="hidden-xs" id="resultBanner">
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
                    <li class="active">Decoración Temática</li>
                </ol>
            </div>
            <!-- END  -->
            <!-- SLIDE LEFT -->
            <aside class="col-sm-4 col-md-3 col-lg-3 content-aside" style="padding-top: 0px;padding-bottom: 0px;">

                <div class="section-divider"></div>

            </aside>
            <!-- END SLIDE -->

            <section class="col-sm-8 col-md-9 col-lg-9 content-center">
                <h3>PACKS TEMÁTICOS DISPONIBLES</h3>
                <div class="products-list row">
                    @foreach($combos['_combos'] as $combo)
                        <div class="product-preview">
                            <div class="preview ">
                                <a href="" class="preview-image">
                                    <img class="bordegris" src="{{URL::asset('/imagenweb/otro/' . trim($combo['NombreImagen2']))}}" width="270" height="328" alt="" alt="{{trim($combo['NombreImagen2'])}}">
                                </a>
                                <ul class="product-controls-list right hide-right">
                                    <li class="top-out-small"></li>
                                </ul>
                            </div>
                            <h3 class="title nombreProducto">
                                <a href="" class="preview-image">
                                    {{$combo['Combo']}}
                                </a>
                            </h3>
                            <span class="price new">{{((isset($combo['Precio']) && $combo['Precio'])? '$'.number_format($combo['Precio'], 0, ",", ".") : '' )}}
                                <small>({{(isset($combo['NroInvitados']) && $combo['NroInvitados']) ? $combo['NroInvitados']:'0'}}
                                    personas)</small></span><!--rating-->
                            <!--description-->
                            <div class="list_description">{{$combo['Combo']}}</div>
                            <!--buttons-->
                        </div>
                    @endforeach


                </div>
            </section>
        </div>

    </section>

@stop


@section('javascript')
    <script>

    </script>
@stop