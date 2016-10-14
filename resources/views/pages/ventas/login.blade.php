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
            <section class="col-sm-4 col-md-4 col-lg-4">
                @include('pages.ventas.modulo_registro')
            </section>
            <section class="col-sm-4 col-md-4 col-lg-4">
                @include('pages.ventas.modulo_invitado')
            </section>
            <section class="col-sm-4 col-md-4 col-lg-4">
                @include('pages.ventas.modulo_acceso')
            </section>


        </div>
    </section>

@stop



