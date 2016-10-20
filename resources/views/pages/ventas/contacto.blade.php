@extends('layouts.ventas.default')

@section('titulo', 'Contacto')

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
            <img src="{{Asset::img('contacto.jpg')}}" alt="" width="100%">
        </section>
    </div>
    <!-- END BANNER -->

    <section class="container">
        <div class="row">
            <!-- BREADCRUMB -->
            <div class="col-md-12">
                <ol class="breadcrumb no-margin">
                    <li><a href="/">Ventas</a></li>
                    <li class="active">Contacto</li>
                </ol>
            </div>
            <!-- END  -->
            <!-- SLIDE LEFT -->
            <aside class="col-sm-4 col-md-3 col-lg-3 content-aside" style="padding-top: 0px;padding-bottom: 0px;">

            </aside>
            <!-- END SLIDE -->

            <section class="col-sm-8 col-md-9 col-lg-9 content-center">
                <h3>FORMULARIO DE CONTACTO</h3>
                <p class="subtitulo">Llene el siguiente formulario y lo contactaremos a la brevedad</p>

                <div class="row">
                    <!-- CONTENIDO -->

                    <div id="tipoConsulta" class="col-md-12 m-bot">
                        <label class="radio-inline">
                            <input type="radio" name="data[Cliente][tipo]" id="inlineRadio1" value="VEN"> Ventas
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="data[Cliente][tipo]" id="inlineRadio2" value="ARR"> Arriendo
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="data[Cliente][tipo]" id="inlineRadio3" value="LAV"> Lavandería
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="data[Cliente][tipo]" id="inlineRadio4" value="OTR"> Otro
                        </label>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Asunto de consulta</label>
                                    {{ Form::input('text', 'rutcliente', null, ['class' => 'form-control', 'placeholder' => 'Ej: 11111111-1', 'id' => 'rutcliente']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre completo</label>
                                    {{ Form::input('text', 'rutcliente', null, ['class' => 'form-control', 'id' => 'rutcliente']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Correo electrónico</label>
                                    {{ Form::input('text', 'rutcliente', null, ['class' => 'form-control','id' => 'rutcliente']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 m-bot">
                        <div class="form-group">
                            <label>Escriba su solicitud</label>
                            {{ Form::textarea('rutcliente', null, ['class' => 'form-control', 'id' => 'rutcliente']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-4">
                                <p class="text-muted">Al enviar su consulta será derivado(a) al área correspondiente y
                                    contactado en un máximo de 48 horas por un ejecutivo</p>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-default btn-block boton-enviar" rel="enviar">Enviar
                                    <i class="glyphicon glyphicon-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- FIN CONTENIDO -->
                </div>
            </section>
        </div>

    </section>

@stop

@section('javascript')
    <script>
        $('#ClienteContactoForm')[0].reset();
        $('#ClienteContactoForm .form-control').attr('disabled', true);
        $(document).on('change', '#ClienteContactoForm input[name="data[Cliente][tipo]"]', function () {
            var tipo = $(this).val();
            $('#ClienteAsunto').val(false).html('');
            $('.form-control').attr('disabled', true);
            $.ajax({
                async: true,
                dataType: "json",
                type: 'POST',
                url: '',
                data: {
                    tipo: tipo
                },
                success: function (respuesta) {
                    if (respuesta.estado == 'OK') {
                        var opciones = '<option value="">- seleccione asunto</option>';
                        $.each(respuesta.result, function (index, elemento) {
                            opciones += '<option value="' + elemento.Id + '">' + elemento.Nombre + '</option>';
                        });
                        $('#ClienteAsunto').val(false).html(opciones);
                        $('.form-control').removeAttr('disabled');
                    } else {
                        $.alerta((respuesta.mensaje) ? respuesta.mensaje : 'Error...');
                    }
                }
            });
        });

        $(document).on('click', 'button[rel="enviar"]', function () {
            $('#tipoConsulta').removeClass('has-error');
            if (!$('input[name="data[Cliente][tipo]"]:checked').length) {
                $('#tipoConsulta').addClass('has-error');
                $.alerta('Para continuar debe señalar el tipo de consulta que desea realizar, seleccionando la opcion de ventas, arriendo, lavandería u otros.');
                return false;
            }
            var errores = '';
            $('#ClienteContactoForm .form-group.has-error').removeClass('has-error');
            $('#ClienteContactoForm .form-control').each(function (index, campo) {
                if (!$(campo).val()) {
                    $(campo).parents('.form-group').addClass('has-error');
                    errores += '<br>- ' + $(campo).parents('.form-group').find('label').text();
                }
            });
            if ($('#ClienteContactoForm .form-group.has-error').length) {
                $.alerta('Para continuar debe ingresar: ' + errores);
                return false;
            }

            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test($('#ClienteContactoForm #ClienteEmail').val())) {
                $('#ClienteContactoForm #ClienteEmail').parents('.form-group').addClass('has-error');
                $.alerta('Para continuar debe ingresar una cuenta de correo válida.');
                return false;
            }

            $(this).parents('form').submit()
        });
    </script>
@stop


