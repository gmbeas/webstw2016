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
            @if($invitado)
            <section class="col-sm-4 col-md-4 col-lg-4">
                @include('pages.ventas.modulo_registro')
            </section>
            <section class="col-sm-4 col-md-4 col-lg-4">
                @include('pages.ventas.modulo_acceso')
            </section>
            <section class="col-sm-4 col-md-4 col-lg-4">
                @include('pages.ventas.modulo_invitado')
            </section>
            @else
                <section class="col-sm-6 col-md-6 col-lg-6">
                    @include('pages.ventas.modulo_registro')
                </section>
                <section class="col-sm-6 col-md-6 col-lg-6">
                    @include('pages.ventas.modulo_acceso')
                </section>
            @endif

        </div>
    </section>

@stop

@section('javascript')
    <script>
        $(document).on('change', '#rutclientereg', function () {
            var target = $(this),
                    rut = $(this).val();
            if (rut.length > 1) {
                var newRut = '',
                        dv = '';
                for (x = 0; x < rut.length; x++) {
                    if (x == (rut.length - 1)) {
                        dv = rut[x];
                    } else if (!isNaN(rut[x])) {
                        newRut += rut[x];
                    }
                }
                $(target).val(format(newRut) + '-' + dv);
            }
        });

        $(document).on('change', '#rutcliente', function () {
            console.log(1);
            var target = $(this),
                    rut = $(this).val();
            if (rut.length > 1) {
                var newRut = '',
                        dv = '';
                for (x = 0; x < rut.length; x++) {
                    if (x == (rut.length - 1)) {
                        dv = rut[x];
                    } else if (!isNaN(rut[x])) {
                        newRut += rut[x];
                    }
                }
                $(target).val(format(newRut) + '-' + dv);
            }
        });

        function format(input) {
            var num = input;
            if (!isNaN(num)) {
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
                num = num.split('').reverse().join('').replace(/^[\.]/, '');
                return num
            } else {
                alert('Solo se permiten numeros');
            }
        }

    </script>
@stop


