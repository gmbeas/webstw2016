@extends('layouts.arriendo.default')

@section('titulo', 'Categoría')

@section('css')
    <style>
        .glyphicon-spin {
            -webkit-animation: spin 1000ms infinite linear;
            animation: spin 1000ms infinite linear;
        }
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(359deg);
                transform: rotate(359deg);
            }
        }
        @keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(359deg);
                transform: rotate(359deg);
            }
        }
        a.prefijo, #lista-lineas a.linea {
            font-weight: normal;
        }
        a.prefijo.activo, #lista-lineas a.linea.activo {
            font-weight: bold;
        }
        #recogerCategorias, #lineasTodas {
            outline: none;
        }
        #lista-categorias > li.categorias > span.name {
            font-size: 1.1em;
            background-color: #eee;
            padding-left: 3px;
            border-bottom: 1px solid #fff;
        }
        #lista-categorias > li.categorias > ul > li {
            font-size: 0.9em;
        }
    </style>
@stop

@section('content')
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <!-- BANNER CATEGORIA -->
    <div class="container">
        <section class="hidden-xs" id="resultBanner">
        </section>
    </div>
    <!-- END BANNER -->

    <section class="container">
        <div class="row">
            <!-- BREADCRUMB -->

            <!-- END  -->

            <!-- SLIDE LEFT -->
            <aside class="col-sm-4 col-md-3 col-lg-3 content-aside" style="padding-top: 0px;padding-bottom: 0px;">
                @include('pages.arriendo.categoria_izquierda')
                <div class="section-divider"></div>

                <div class="section-divider"></div>

            </aside>
            <!-- END SLIDE -->
            <section class="col-sm-8 col-md-9 col-lg-9 content-center">
                <div class="section-divider" style="padding-top: 0px;padding-bottom: 0px;"></div>
                <h3 id="TituloPrefijo"><?= $nombre;?></h3>
                <!-- BOX CATEGORIAS -->

                <!-- END BOX -->
                <div class="products-list row" id="resultLineas" style="display: none;"></div>
                <div class="products-list" id="resultProductos" data-arbol="{{Request::segment(3)}}" data-prfid="{{Request::segment(4)}}">

                </div>
            </section>
        </div>

    </section>

@stop

@section('javascript')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        jQuery.formatNumber = function(Number){
            return Number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };

        function slug(title, separator) {
            if(typeof separator == 'undefined') separator = '-';

            // Convert all dashes/underscores into separator
            var flip = separator == '-' ? '_' : '-';
            title = title.replace(flip, separator);

            // Remove all characters that are not the separator, letters, numbers, or whitespace.
            title = title.toLowerCase()
                    .replace(new RegExp('[^a-z0-9' + separator + '\\s]', 'g'), '');

            // Replace all separator characters and whitespace by a single separator
            title = title.replace(new RegExp('[' + separator + '\\s]+', 'g'), separator);

            return title.replace(new RegExp('^[' + separator + '\\s]+|[' + separator + '\\s]+$', 'g'),'');
        }


        function desplegarLineas(linea, id) {
            if (! linea) {
                return false;
            }
            var boton = $('#resultCategorias #lista-lineas a[rel="btnLinea"][data-linea="'+linea+'"]');

            if ($('h3#TituloPrefijo > small').length) {
                $('h3#TituloPrefijo > small').remove();
            }
            $('#resultCategorias #lista-lineas a').removeClass('activo');
            $(boton).addClass('activo');

            if ($('h3#TituloPrefijo').length) {
                $('h3#TituloPrefijo').append(' <small> &raquo; '+linea+'</small>');
            }
            if ($('#resultLineas').length && $('#resultLineas').is(':visible')) {
                $('#resultLineas').fadeOut(500, function() {
                    $('div.product-preview').addClass('noMostrar');
                    $('div.product-preview.modulo-oferta').removeClass('noMostrar');

                    $('.nombreBusqueda:contains("'+linea.toLowerCase()+' ")').each(function(index,elemento) {
                        $(elemento).parent().removeClass('noMostrar');
                    });
                    $('html, body').animate({
                        scrollTop: $("#resultProductos").parent().offset().top
                    }, 300);
                    $('#resultProductos').fadeIn(800);
                });
            } else {
                $('#resultProductos').fadeOut(500, function() {
                    $('div.product-preview').addClass('noMostrar');
                    $('div.product-preview.modulo-oferta').removeClass('noMostrar');
                    $('.nombreBusqueda:contains("'+linea.toLowerCase()+' ")').each(function(index,elemento) {
                        $(elemento).parent().removeClass('noMostrar');
                    });
                    $('html, body').animate({
                        scrollTop: $("#resultProductos").parent().offset().top
                    }, 300);
                    $('#resultProductos').fadeIn(800);
                });
            }

            $('#lista-lineas > li > ul').slideUp(200);

            if ($(boton).parents('li').find('ul[rel="filtrosLineas"]').length) {
                if ($(boton).parents('li').find('ul[rel="filtrosLineas"]').is(':visible')) {
                    $(boton).parents('li').find('ul[rel="filtrosLineas"] input.filtros').prop('checked', false);
                } else {
                    $(boton).parents('li').find('ul[rel="filtrosLineas"]').slideDown(300);
                }
                return false;
            }
            $(boton).parents('li').append('<ul rel="filtrosLineas"></ul>');
            var target = $(boton).parents('li').find('ul[rel="filtrosLineas"]');
        }

        function cargarProductos(mostrar) {
            var targetProductos = $('div#resultProductos');
            var targetBanner = $('#resultBanner');
            var arbol = $(targetProductos).data('arbol');
            var prfid = $(targetProductos).data('prfid');

            $.ajax({
                type: "POST",
                url: '{{URL::to('arriendo/traeproductos')}}',
                data: {'arbol' : arbol, 'prfid' : prfid, '_token' : token},
                success: function(response) {
                    var respuesta = JSON.parse(response);
                    console.log(respuesta);
                    var banner = false;
                    if(respuesta['_productos'].length > 0){
                        var contenido = '';
                        $.each(respuesta['_productos'], function(index, registro) {
                            var precio = 0;
                            if (registro.PrecioUnidadBruto) {
                                precio = $.formatNumber(registro.PrecioUnidadBruto).toString();
                            } else {
                                if (registro.PrecioBruto) {
                                    precio = $.formatNumber(registro.PrecioBruto).toString();
                                }
                                if ($.trim(registro.Um) != 'CU') {
                                    precio+=' '+$.trim(registro.Um);
                                }
                            }
                            var urlimage = '{{URL::asset('/imagenweb/sku/')}}';
                            var urlficha = '{{ URL::to('/arriendo/ficha/')}}';
                            var ficha = urlficha + '/' + registro.Sku + '/' + slug(registro.NombreWeb, '-') + '.html';
                            var imagen = urlimage + '/' + $.trim(registro.Foto);
                            contenido+= '<div class="product-preview" style="height: 400px;" data-prefijo_id="'+registro.Prf_Id+'">'+
                                    '<div class="preview ">'+
                                    '<a href="' + ficha + '" class="preview-image">'+
                                    '<img class="bordegris" src="' + imagen + '" width="270" height="270" alt="">'+
                                    '</a>'+
                                    '<ul class="product-controls-list right hide-right">'+
                                    '<li class="top-out-small"></li>'+
                                    '</ul>'+
                                    '</div>'+
                                    '<h3 class="title nombreProducto">'+
                                    '<a href="' + ficha + '" class="preview-image">'+registro.NombreWeb+'</a>'+
                                    '</h3>'+
                                    '<span class="price new">$ '+precio+'</span>'+
                                    '<div class="list_description">'+registro.NombreWeb+'</div>'+
                                    '<div class="nombreBusqueda hidden">'+registro.NombreWeb.toLowerCase()+'</div>'+
                                    '<div class="list_buttons">'+
                                    '<a class="btn btn-mega pull-left" href="#">Add to Cart</a>'+
                                    '</div>'+
                                    '</div>';



                        });

                        $(targetProductos).fadeOut(300,function() {
                            $(targetProductos).html(contenido);
                            if (mostrar) {
                                $(targetProductos).fadeIn(500);
                            }
                        });
                    }
                }
            });
        }

        function cargarCategorias() {
            var targetCategorias = $('#resultCategorias');
            var arbol = $(targetCategorias).data('arbol');
            var prfid = $(targetCategorias).data('prfid');

            $.ajax({
                type: "POST",
                url: '{{URL::to('arriendo/traecategorias')}}',
                data: {'arbol' : arbol, 'prfid' : prfid, '_token' : token},
                success: function(response) {
                    var respuesta = JSON.parse(response);
                    var mostrar = true;
                    if(respuesta['_atributos'].length > 0){
                        var contenido = '<h3>Filtros</h3><ul class="expander-list" id="lista-atributos"><form>';

                        $.each(respuesta['_atributos'], function(index, registro) {

                            contenido+= '<li class="grupos" data-grupo ="' + registro.GrupoId + '"><span class="name"><span class="expander">-</span> <a href="#">' + registro.Atributo + '</a></span><ul>';
                            $.each(registro['Grupo'] ,function(index2,valor) {
                                contenido+= '<li><input type="checkbox" class="filtros"  name="'+valor.Grp_Id+'" value="'+valor.Atributo.toLowerCase()+'" multiple="multiple"> '+valor.Atributo+'</li>';
                            });
                            contenido+= '</ul></li>';
                        });

                        contenido+= '</form></ul>';
                        $(targetCategorias).html(contenido);

                    }else if(respuesta['_prefijos'].length > 0){
                        var contenido = '<h3>Categorias<a href="#" class="btn btn-xs btn-default pull-right" id="recogerCategorias"><small>ver todas</small></a></h3>'+
                                '<ul class="expander-list" id="lista-categorias">';

                        $.each(respuesta['_prefijos'] ,function(categoriaId, filtroCategoria) {
                            contenido+= '<li class="categorias" data-categoria="'+filtroCategoria.Prf_Id+'">'+
                                    '<span class="name">'+
                                    '<a href="#" class="prefijo" rel="btnPrefijo">'+filtroCategoria.Prefijo+'</a>'+
                                    '</span>'+
                                    '<ul>';
                            $.each(filtroCategoria['_atributos'], function(grupo, filtros) {
                                contenido+= '<li>'+
                                        '<span class="name">'+
                                        '<span class="expander">-</span> '+
                                        '<a href="#">'+filtros.Atributo+'</a>'+
                                        '</span>'+
                                        '<ul style="padding-left: 20px;">';
                                $.each(filtros['Grupo'],function(filtroId,filtroNombre) {
                                    contenido+= '<li rel="filtro">'+
                                            '<input type="checkbox" class="filtros"  name="data[' + filtros.Atributo + '][filtro]" value="'+filtroNombre.Atributo+'" multiple="multiple"> '+filtroNombre.Atributo+
                                            '</li>';
                                });
                                contenido+= '</ul></li>';
                            });


                            contenido+= '</ul></li>';
                        });

                        contenido+= '</ul>';

                        $(targetCategorias).html(contenido);

                    }else if(respuesta['_lineas'].length > 0){
                        var contenido = '<h3>Líneas<a href="#" class="btn btn-xs btn-default pull-right" id="lineasTodas"><small>ver todas</small></a></h3><ul class="expander-list" id="lista-lineas">';

                        $.each(respuesta['_lineas'], function(index, linea) {
                            contenido+= '<li>'+
                                    '<span class="name">'+
                                    '<a href="#" class="linea" rel="btnLinea" data-linea="'+linea.Atributo+'" data-id="'+linea.Atd_Id+'">'+linea.Atributo+'</a>'+
                                    '</span>'+
                                    '</li>';
                        });

                        contenido+= '</ul>';
                        $(targetCategorias).html(contenido);

                        var iconos = '';
                        $.each(respuesta['_lineas'], function(index, linea) {

                            var urlimage = '{{URL::asset('/imagenweb/arbol/')}}';
                            var imagen = urlimage + '/' + $.trim(linea.FotoAtributo);


                            var imagen = 'http://placehold.it/270x270';
                            if (linea.foto) {
                                imagen = imagen;
                            }
                            iconos+= '<div class="product-preview" style="height: 400px;">'+
                                    '<div class="preview ">'+
                                    '<a href="#" class="linea" rel="btnLinea" data-linea="'+linea.Atributo+'" data-id="'+linea.Atd_Id+'" class="preview-image">'+
                                    '<img class="bordegris" src="'+imagen+'" width="270" height="270" alt="">'+
                                    '</a>'+
                                    '<ul class="product-controls-list right hide-right">'+
                                    '<li class="top-out-small"></li>'+
                                    '</ul>'+
                                    '</div>'+
                                    '<h3 class="title nombreProducto">'+
                                    '<a href="#" class="linea" rel="btnLinea" data-linea="'+linea.Atributo+'"><b>'+linea.Atributo+'</b></a>'+
                                    '</h3>'+
                                    '</div>';
                        });
                        $('#resultLineas').html(iconos).fadeIn(500);
                        mostrar = false;
                    }

                    if ($('div#resultProductos').length) {
                        cargarProductos(mostrar);
                    }

                    if ($(".expander-list").length) {
                        $(".expander-list").find("ul").hide().end().find(" .expander").text("+").end().find(".active").each(function () {
                            $(this).parents("li ").each(function () {
                                var $this = $(this),
                                        $ul = $this.find("> ul"),
                                        $name = $this.find("> .name a"),
                                        $expander = $this.find("> .name .expander");
                                $ul.show();
                                $name.css("font-weight", "bold");
                                $expander.html("&minus;")
                            })
                        }).end().find(" .expander").each(function () {
                            var $this = $(this),
                                    hide = $this.text() === "+",
                                    $ul = $this.parent(".name").next("ul"),
                                    $name = $this.next("a");
                            $this.click(function () {
                                if ($ul.css("display") ==
                                        "block") $ul.slideUp("slow");
                                else $ul.slideDown("slow");
                                $(this).html(hide ? "&minus;" : "+");
                                $name.css("font-weight", hide ? "bold" : "normal");
                                hide = !hide
                            })
                        });
                    }
                }
            });

        }



        $(document).ready(function() {
            $('div#resultProductos').html('<div class="well well-xs text-center"><span class="glyphicon glyphicon-repeat glyphicon-spin"></span> CARGANDO </div>');
            if ($('#resultCategorias').length) {
                cargarCategorias();
            }

            $(document).on('click','ul.expander-list li > .name > a',function(e) {
                e.preventDefault();
                var boton = $(this);
                if ($(boton).siblings('span.expander').length) {
                    $(boton).siblings('span.expander').click();
                }
            });

            $(document).on('click','#lineasTodas',function(e) {
                e.preventDefault();
                if ($('h3#TituloPrefijo > small').length) {
                    $('h3#TituloPrefijo > small').remove();
                }
                $('#resultCategorias #lista-lineas a').removeClass('activo');
                $('ul#lista-lineas > li ul').slideUp(200).find('input.filtros').prop('checked',false);
                $('#resultProductos').fadeOut(500, function() {
                    $('div.product-preview').removeClass('noMostrar');
                    $('#resultLineas').fadeIn(800);
                });
            });

            $(document).on('click','#resultCategorias #lista-lineas a[rel="btnLinea"], #resultLineas a[rel="btnLinea"]',function(e) {
                e.preventDefault();
                var id = $(this).data('id'),
                        linea = $(this).data('linea');
                desplegarLineas(linea, id);
            });

            $(document).on('click','#resultCategorias #recogerCategorias', function(e) {
                e.preventDefault();
                if ($('h3#TituloPrefijo > small').length) {
                    $('h3#TituloPrefijo > small').remove();
                }
                $('#lista-categorias.expander-list > li.categorias').each(function(index,elemento) {
                    $(elemento).children('ul').slideUp("slow");
                    $(elemento).find('a[rel="btnPrefijo"]').removeClass('activo');
                });
                $('#resultProductos').fadeOut(500, function() {
                    if ($('input.filtros:checked').length) {
                        $('input.filtros:checked').attr('checked',false);
                    }
                    $('.product-preview').hide().removeClass('noMostrar').show();
                    $('#resultProductos').fadeIn(800);
                });
            });

            $(document).on('click','#resultCategorias #lista-categorias.expander-list > li.categorias > span.name > a[rel="btnPrefijo"]', function() {
                var categoria_id = $(this).parents('li.categorias').data('categoria');// categoria seleccionada
                if ($('h3#TituloPrefijo > small').length) {
                    $('h3#TituloPrefijo > small').remove();
                }
                // recorrer menu de categorias
                $('#lista-categorias.expander-list > li.categorias').each(function(index,elemento) {
                    var target = $(elemento).find('a[rel="btnPrefijo"]');

                    if ($(elemento).data('categoria') != categoria_id) {
                        // si la categoria no es la seleccionada oculta atributos
                        $(elemento).children('ul').slideUp("slow");
                        $(target).removeClass('activo');
                    } else {
                        // si la categoria es la seleccionada
                        if ($(target).hasClass('activo')) {     // verifica si esta abierto el submenu para cerrarlo
                            $(target).removeClass('activo');
                            $(elemento).children('ul').slideUp("slow");
                        } else {     // verifica si esta cerrado el submenu para abrirlo
                            $(target).addClass('activo');
                            $(elemento).children('ul').slideDown("slow");
                            // muestra en titulo el prefijo que se esta viendo
                            if ($('h3#TituloPrefijo').length) {
                                $('h3#TituloPrefijo').append(' <small> &raquo; '+$(target).text()+'</small>');
                            }
                        }
                    }
                });
                $('#resultProductos').fadeOut(500, function() {
                    $('div.product-preview').removeClass('noMostrar');
                    if ($('input.filtros:checked').length) {
                        $('input.filtros:checked').attr('checked',false);
                    }
                    if ($('#lista-categorias.expander-list > li.categorias > .name > a.prefijo.activo').length) {
                        $('.product-preview').hide();
                        $('.product-preview[data-prefijo_id="'+categoria_id+'"]').show();
                    } else {
                        $('.product-preview').show();
                    }
                    $('#resultProductos').fadeIn(800);
                });
            });

            $(document).on('change','#resultCategorias #lista-atributos .filtros',function() {
                $('#resultProductos').fadeOut(500, function() {
                    $('div.product-preview').addClass('noMostrar');
                    $('div.product-preview.modulo-oferta').removeClass('noMostrar');

                    if($('input.filtros:checked').length ==0) {
                        $('div.product-preview').removeClass('noMostrar');
                        $('#resultProductos').fadeIn(800);
                        return false;
                    }
                    var inicial = true;
                    $('#lista-atributos li.grupos').each(function() {
                        if(inicial) {
                            $('input.filtros[name="'+$(this).data("grupo")+'"]:checked').each(function() {
                                $(".nombreBusqueda:contains('"+$(this).val()+"')").each(function() {
                                    $(this).parent().removeClass('noMostrar');
                                });
                                inicial = false;
                            });
                        } else {
                            filtro ="";
                            $('input.filtros[name="'+$(this).data("grupo")+'"]:checked').each(function() {
                                if(filtro !='') {
                                    filtro += ', ';
                                }
                                filtro += " .nombreBusqueda:contains('"+$(this).val().toLowerCase()+"')";
                            });
                            if(filtro != '') {
                                filtro = '.nombreBusqueda:not('+filtro+')';
                                $(filtro).each(function() {
                                    if($(this).parent().not('.noMostrar')) {
                                        $(this).parent().addClass('noMostrar');
                                    }
                                });
                            }
                        }
                    });

                    if ($('.products-list > .product-view-ajax-container.temp').length) {
                        $('.products-list > .product-view-ajax-container.temp').addClass('hidden');
                    }
                    $('#resultProductos').fadeIn(800);
                });
                return false;
            });

            $(document).on('change','#resultCategorias #lista-categorias .filtros',function() {
                $('#resultProductos').fadeOut(500, function() {
                    $('div.product-preview').addClass('noMostrar');
                    $('div.product-preview.modulo-oferta').removeClass('noMostrar');
                    if (! $('#lista-categorias > li.categorias > ul:visible > li > ul > li > input.filtros:checked').length) {
                        $('div.product-preview').removeClass('noMostrar');
                        $('#resultProductos').fadeIn(800);
                        return false;
                    }

                    var inicial = true;
                    $('#lista-categorias > li.categorias > ul > li').each(function(a,grupo) {
                        if(inicial) {
                            $(grupo).find('input.filtros:checked').each(function(b,atributo) {
                                $(".nombreBusqueda:contains('"+$(atributo).val().toLowerCase()+"')").each(function(c,activo) {
                                    $(activo).parent().removeClass('noMostrar');
                                });
                                inicial = false;
                            });
                        } else {
                            filtro ="";
                            $(grupo).find('input.filtros:checked').each(function(b,atributo) {
                                if(filtro !='') {
                                    filtro += ', ';
                                }
                                filtro += " .nombreBusqueda:contains('"+$(atributo).val().toLowerCase()+"')";
                            });
                            if(filtro != '') {
                                filtro = '.nombreBusqueda:not('+filtro+')';
                                $(filtro).each(function() {
                                    if($(this).parent().not('.noMostrar')) {
                                        $(this).parent().addClass('noMostrar');
                                    }
                                });
                            }
                        }
                    });
                    $('#resultProductos').fadeIn(800);
                });
                return false;
            });

            $(document).on('click', '#lista-lineas ul[rel="filtrosLineas"] a[rel="prefijoFiltroLinea"]', function(e) {
                e.preventDefault();
                var boton = $(this);
                $('a[rel="prefijoFiltroLinea"]').removeClass('activo').css({
                    textDecoration: 'none'
                });
                $(boton).addClass('activo').css({
                    textDecoration: 'underline'
                });
                $('#resultProductos').fadeOut(300, function() {
                    var prefijo = $(boton).text();
                    var linea = $(boton).parents('ul[rel="filtrosLineas"]').siblings('span.name').find('a[rel="btnLinea"]').data('linea');
                    $('div.product-preview').addClass('noMostrar');
                    $('div.product-preview.modulo-oferta').removeClass('noMostrar');
                    $('.nombreBusqueda:contains("'+linea.toLowerCase()+' ")').each(function(index,elemento) {
                        if ($(elemento).is(':contains("'+prefijo.toLowerCase()+' ")')) {
                            $(elemento).parent().removeClass('noMostrar');
                        }
                    });
                    $('html, body').animate({
                        scrollTop: $("#resultProductos").parent().offset().top
                    }, 300);
                    $('#resultProductos').fadeIn(300);
                });
            });
        });
    </script>
@stop