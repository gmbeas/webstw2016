@extends('layouts.ventas.default')

@section('titulo', 'Home')

@section('content')
    <!-- Slider -->
    @include('pages.ventas.slider_home')
    <!-- //end Slider -->

    <div class="container">
        <!-- Services -->
        @include('pages.ventas.servicios')
        <!-- //end Services -->

        <!-- Featured Products -->
        @include('pages.ventas.destacado')
        <!-- //end Featured Products -->

        <!-- Blog widget -->

        <!-- //end Blog widget -->

        <!-- Products widgets -->
        @include('pages.ventas.tipo')
        <!-- //end Products widget -->


        <!-- Social navbar -->
        @include('pages.ventas.newsletter')
        <!-- //end Social navbar -->


        <!-- Brands -->
        @include('pages.ventas.marca')
        <!-- //end Brands -->

    </div>


@stop
@section('javascript')
    <script>
        //swal("Good job!", "You clicked the button!", "success")
    </script>
@stop
