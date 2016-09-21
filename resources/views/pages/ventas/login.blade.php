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


@section('scripts')
    <script>
        function format(input) {
            var num = input;
            if(!isNaN(num)) {
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                num = num.split('').reverse().join('').replace(/^[\.]/,'');
                return num
            } else {
                alert('Solo se permiten numeros');
            }
        }
        $(document).on('change', '#ClienteRut', function() {
            var target = $(this),
                    rut = $(this).val();
            if (rut.length > 1) {
                var newRut = '',
                        dv = '';
                for (x = 0;x < rut.length; x++) {
                    if (x == (rut.length-1)) {
                        dv = rut[x];
                    } else if (! isNaN(rut[x])) {
                        newRut+=rut[x];
                    }
                }
                $(target).val(format(newRut)+'-'+dv);
            }
        });
    </script>
@stop