@extends('layouts.ventas.default')

@section('titulo', 'Login')

@section('content')

    <section class="container">
        <nav class="breadcrumbs"> <a href="#">Home</a> <span class="divider">›</span> Acceso a tu cuenta </nav>
    </section>
    <!-- //end Breadcrumbs -->

    <!-- Two column content -->
    <section class="container">
        <div class="row">
            <section class="col-sm-6 col-md-6 col-lg-6">


            </section>
            <section class="col-sm-6 col-md-6 col-lg-6">
                @include('pages.ventas.modulo_acceso')
            </section>


        </div>
    </section>

@stop



