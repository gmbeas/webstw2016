@extends('layouts.arriendo.default')

@section('titulo', 'Home')

@section('content')
    <!-- Slider -->
    @include('pages.arriendo.slider_home')
    <!-- //end Slider -->

    <div class="container">
        <!-- Services -->
        @include('pages.arriendo.servicios')
        <!-- //end Services -->

            <!-- Featured Products -->
        @include('pages.arriendo.destacado')
        <!-- //end Featured Products -->

            <!-- Blog widget -->

            <!-- //end Blog widget -->

            <!-- Products widgets -->
        @include('pages.arriendo.tipo')
        <!-- //end Products widget -->


            <!-- Social navbar -->
        @include('pages.arriendo.newsletter')
        <!-- //end Social navbar -->


            <!-- Brands -->
        @include('pages.arriendo.marca')
        <!-- //end Brands -->

    </div>
@stop