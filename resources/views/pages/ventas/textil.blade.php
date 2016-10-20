@extends('layouts.ventas.default')

@section('titulo', 'Textil')

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
            <img src="{{Asset::img('textiles.jpg')}}" alt="" width="100%">
        </section>
    </div>
    <!-- END BANNER -->

    <section class="container">
        <div class="row">
            <!-- BREADCRUMB -->
            <div class="col-md-12" style="margin-bottom: 20px;">
                <ol class="breadcrumb no-margin">
                    <li><a href="/">Ventas</a></li>
                    <li class="active">Textil</li>
                </ol>
            </div>
            <!-- END  -->
            <!-- SLIDE LEFT -->
            <aside class="col-sm-4 col-md-3 col-lg-3 content-aside" style="padding-top: 0px;padding-bottom: 0px;">

            </aside>
            <!-- END SLIDE -->

            <section class="col-sm-8 col-md-9 col-lg-9 content-center">
                <h3>DISEÑO, CONFECCIÓN Y LOGÍSTICA DE UNIFORMES DE TRABAJO</h3>
                <!-- <p class="subtitulo"></p> -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{Asset::img('textiles/1.jpg')}}" width="100%"/>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <p style="text-align: justify; line-height: 24px; margin-top: 20px;">La imagen de su
                                    negocio comienza por el uniforme. Somos una empresa con gran experiencia en la
                                    administración y confección de vestuario de trabajo (nacional e importado). Tenemos
                                    gran capacidad de almacenaje de su vestuario que permita sostener sius distintas
                                    entregas masivas o de reposición, somos flexibles en la modalidad de entrega, tales
                                    como montar carpas temporales de entrega de vestuario, centralizar y agrupar a los
                                    distintos proveedores para armar el set de artículos completos para cada una de las
                                    personas de su empresa, distribuyéndolos a través de nuestra tienda textil o con
                                    nuestros operadores logísticos a nivel nacional.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <p style="text-align: justify; line-height: 24px;">Como entendemos que la rotación del personal hoy es
                    un ítem crítico y fundamental a resolver, es que, uno de nuestros principales soportes a nuestros
                    clientes es la mantención de stock de seguridad que les permita abastecer durante un período de
                    tiempo las necesidades instantáneas de vestuario.</p>

                <h3 style="margin: 50px 0 15px 0;">NUESTROS OBJETIVOS COMO EMPRESA TEXTIL</h3>
                <h5 style="text-align: justify; text-transform: none;">Asesorar en forma directa todo el proceso de
                    diseño, compra y abastecimiento de vestuario de trabajo.</h5>
                <img src="{{Asset::img('textiles/2.jpg')}}" width="100%" style="border: 1px solid #ccc;"/>
                <h5 style="text-align: justify; text-transform: none; margin-top: 50px;">Agrupar y coordinar a los
                    proveedores para eficientar el proceso de entrega de vestuario y liberar a las áreas de Compra, RHH
                    o prevención de riesgo de la operación de entrega de vestuario.</h5>
                <img src="{{Asset::img('textiles/3.jpg')}}" width="100%" style="border: 1px solid #ccc;"/>
                <h5 style="text-align: justify; text-transform: none; margin-top: 50px;">Mantener al cliente siempre
                    informado de las distintas etapas del proceso.</h5>
                <img src="{{Asset::img('textiles/4.jpg')}}" width="100%" style="border: 1px solid #ccc;"/>

            </section>
        </div>

    </section>

@stop

@section('javascript')
    <script>

    </script>
@stop


