@extends('layouts.ventas.default')

@section('titulo', 'Lavandería')

@section('content')
    <style>
        p.subtitulo {
            color: #ff9c00;
            border-bottom: 2px solid #888;
            font-size: 14px;
            font-weight: 600;
            /*padding: 3px;*/
        }

        .radio-inline {
            margin-right: 40px;
        }

        .m-bot {
            margin-bottom: 30px;
        }

        #ClienteContactoForm label {
            font-weight: bold;
        }

        .boton-enviar {
            background-color: #c00232;
            color: #FFF;
        }
    </style>

    <!-- BANNER CATEGORIA -->
    <div class="container">
        <section class="hidden-xs">
            <img src="{{Asset::img('lavanderia.jpg')}}" alt="" width="100%">
        </section>
    </div>
    <!-- END BANNER -->

    <section class="container">
        <div class="row">
            <!-- BREADCRUMB -->
            <div class="col-md-12" style="margin-bottom: 20px;">
                <ol class="breadcrumb no-margin">
                    <li><a href="/">Ventas</a></li>
                    <li class="active">Lavandería</li>
                </ol>
            </div>
            <!-- END  -->
            <!-- SLIDE LEFT -->
            <aside class="col-sm-4 col-md-3 col-lg-3 content-aside" style="padding-top: 0px;padding-bottom: 0px;">

            </aside>
            <!-- END SLIDE -->

            <section class="col-sm-8 col-md-9 col-lg-9 content-center">
                <h3>SERVICIO DE LAVANDERÍA</h3>
                <!-- <p class="subtitulo"></p> -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5" style="padding-left: 0;">
                            <img src="{{Asset::img('lavanderia/1.jpg')}}" width="100%"/>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <p style="text-align: justify; line-height: 24px; margin-top: 20px;">Porque sabemos que
                                    la imagen de tu negocio es fundamental, las prendas de vestir y textil deben lucir
                                    impecables. Pensando en esto. Steward ha desarrollado Cleaners, un exclusivo
                                    servicio de lavado, especialistas en el sector Hotelero, Gastronómico, Alimenticio e
                                    Industrial, donde la calidad de servicio, higiene y presentación es primordial.</p>
                                <p style="text-align: justify; line-height: 24px; margin-top: 20px;">Dentro de nuestros
                                    servicios podrás optar por: lavandería, arriendo y administración de ropa de
                                    trabajo, mantelería y lencería par ahoteles.</p>
                                <p style="text-align: justify; line-height: 24px; margin-top: 20px;">Porque Steward es
                                    calidad y confianza, para los que saben.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <p style="text-align: justify; line-height: 24px;"></p>
                <h3 style="margin: 50px 0 15px 0;">&nbsp;</h3>
                <h5 style="text-align: justify; text-transform: none;">IMAGENES</h5>
                <img src="{{Asset::img('lavanderia/2.jpg')}}"/>
                <h5 style="text-align: justify; text-transform: none; margin-top: 20px;">Dentro de nuestros servicios
                    podrá optar por</h5>
                <ul style="margin-bottom: 40px; padding-left: 20px;">
                    <li style="padding: 5px 0;">Servicio de lavandería, secado y planchado industrial.</li>
                    <li style="padding: 5px 0;">Provisión de vestuario.</li>
                    <li style="padding: 5px 0;">Administración de uniformes, mantelería y lencería para hoteles.</li>
                </ul>
                <img src="{{Asset::img('lavanderia/3.jpg')}}" width="100%"/>
                <h5 style="text-align: justify; text-transform: none; margin-top: 20px;">Infraestructura dedicada</h5>
                <ul style="margin-bottom: 40px; padding-left: 20px;">
                    <li style="padding: 5px 0;">6 máquinas automáticas de lavado con capacidad de 500 kilos por hora.
                    </li>
                    <li style="padding: 5px 0;">Dobladoras.</li>
                    <li style="padding: 5px 0;">2 rodillos de planchado autosoportados con ancho útil de 3.3 metros.
                    </li>
                    <li style="padding: 5px 0;">1 túnel de secado/planchado con capacidad de 500 prendas por hora.</li>
                    <li style="padding: 5px 0;">Pozo de agua propia con planta de tratamiento de ablandado y tratamiento
                        de Riles.
                    </li>
                </ul>
                <img src="{{Asset::img('lavanderia/4.jpg')}}" width="100%"/>
                <h5 style="text-align: justify; text-transform: none; margin-top: 20px;">Por qué confiar en
                    nosotros</h5>
                <ul style="margin-bottom: 40px; padding-left: 20px;">
                    <li style="padding: 5px 0;">Continuidad y consistencia en la calidad de lavado.</li>
                    <li style="padding: 5px 0;">Tiempo de respuesta de 24 horas.</li>
                    <li style="padding: 5px 0;">Despacho y distribuición directa en Santiago y zonas aledañas.</li>
                    <li style="padding: 5px 0;">Control de calidad de nuestros procesos y los artículos de nuestros
                        clientes.
                    </li>
                </ul>
            </section>
        </div>

    </section>

@stop

@section('javascript')
    <script>

    </script>
@stop


