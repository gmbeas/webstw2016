@extends('layouts.ventas.default')

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
                @include('pages.ventas.categoria_izquierda')
                <div class="section-divider"></div>

                <div class="section-divider"></div>

            </aside>
            <!-- END SLIDE -->
            <section class="col-sm-8 col-md-9 col-lg-9 content-center">
                <div class="section-divider" style="padding-top: 0px;padding-bottom: 0px;"></div>
                @php
                    $nombre = str_replace("-", " ", $nombre);
                    $nombre = str_replace(".html", "", $nombre);
                @endphp
                <h3 id="TituloPrefijo">{{str_replace("-", " ", $nombre)}}</h3>


                <!-- Filters -->
                <div class="filters-panel">
                    <div class="row">
                        <div class="col-sm-5 col-md-5 col-lg-5"> Ordenar por
                            <div class="btn-group btn-select sort-select sort-isotope">
                                <a href="#" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <span class="value">Por nombre</span>
                                    <span class="caret min"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" data-value="name">Por nombre</a></li>
                                    <li><a href="#" data-value="price-down">Precio de menor a mayor</a></li>
                                    <li><a href="#" data-value="price-up">Precio de mayor a menor</a></li>
                                </ul>
                            </div>
                            <a href="#" class="sort-select-arrow up">
                                <span class="up icon-arrow-up-3"></span>
                                <span class="down icon-arrow-down-3"></span>
                            </a>
                        </div>
                        <div class="col-md-4 col-lg-4 hidden-sm hidden-xs">
                            <div class="view-mode"> Ver como:&nbsp; <a href="#" class="view-grid"><span
                                            class="icon-th"></span></a>&nbsp;&nbsp;<a href="#" class="view-list"><span
                                            class="icon-th-list"></span></a></div>
                        </div>

                    </div>

                    <div class="clearfix"></div>
                </div>
                <!-- //end Filters -->

                <!-- Products list -->
                <div class="hidden-xs row">
                    <div class="products-list row" id="resultLineas" style="display: none;"></div>
                    <div class="products-list" id="resultProductos" data-arbol="{{Request::segment(2)}}"
                         data-prfid="{{Request::segment(3)}}"></div>
                </div>
                <!-- //end Products list -->

            </section>
        </div>

    </section>

@stop

@section('javascript')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        var $isotop = $('#resultProductos');

        var testprefijo = "";


        $.formatNumber = function (Number) {
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

        //cargarProductos(true);

        function recarga() {
            if ($isotop.length) {
                var $sortAscending = $(".sort-select-arrow");
                if ($.support.opacity) window.onresize = function () {
                    $isotop.isotope({
                        masonry: {}
                    })
                };
                $isotop.isotope({
                    itemSelector: ".product-preview",
                    layoutMode: "fitRows",
                    masonry: {},
                    resizable: false,
                    sortBy: "name",
                    sortAscending: true,
                    getSortData: {
                        price: function ($elem) {
                            return parseFloat($elem.find(".price:last").text().replace("$", "").replace(".", ""))
                        },
                        name: function ($elem) {
                            return $elem.find(".list_description").text()
                        }
                    }
                });


                $(".sort-select").change(function (e, data) {
                    //$(".sort-select .value").html(data.html);
                    var sort = "";
                    var updown = false;
                    if (data.value) {
                        if (data.value == "name") {
                            sort = data.value;
                            updown = true;
                        } else if (data.value == "price-down") {
                            sort = "price";
                            updown = true;
                            $sortAscending.removeClass("down").addClass("up")
                        }
                        else if (data.value == "price-up") {
                            sort = "price";
                            updown = false;
                            $sortAscending.removeClass("up").addClass("down")
                        }
                        $isotop.isotope({
                            sortBy: sort,
                            layoutMode: "masonry",
                            sortAscending: updown
                        });
                    }
                });

            }

            var viewGrid = $(".view-grid"),
                    viewList = $(".view-list"),
                    productList = $(".products-list");
            viewGrid.click(function (e) {
                productList.removeClass("products-list-in-row").addClass("products-list-in-column");
                $isotop.isotope({
                    masonry: {}
                })
                e.preventDefault()
            });
            viewList.click(function (e) {
                productList.removeClass("products-list-in-column").addClass("products-list-in-row");
                $isotop.isotope({
                    masonry: {}
                })
                e.preventDefault()
            });


        }

        function desplegarLineas(linea, id) {
            console.log(id);
            if (!linea) {
                return false;
            }

            var boton = $('#resultCategorias #lista-lineas a[rel="btnLinea"][data-linea="' + linea + '"]');

            if ($('h3#TituloPrefijo > small').length) {
                $('h3#TituloPrefijo > small').remove();
            }
            $('#resultCategorias #lista-lineas a').removeClass('activo');
            $(boton).addClass('activo');

            if ($('h3#TituloPrefijo').length) {
                $('h3#TituloPrefijo').append(' <small> &raquo; ' + linea + '</small>');
            }
            if ($('#resultLineas').length && $('#resultLineas').is(':visible')) {
                $('#resultLineas').fadeOut(500, function () {
                    $isotop.show();

                    var filterValue = ".atributo-" + id;
                    filterValue = filterFns[filterValue] || filterValue;

                    $isotop.isotope({filter: filterValue});
                });
            } else {
                var filterValue = ".atributo-" + id;
                filterValue = filterFns[filterValue] || filterValue;

                $isotop.isotope({filter: filterValue});
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

            //var target = $(boton).parents('li').find('ul[rel="filtrosLineas"]');

        }

        function cargarProductos(mostrar) {

            var targetBanner = $('#resultBanner');
            var arbol = $isotop.data('arbol');
            var prfid = $isotop.data('prfid');

            //console.log(arbol);

            $.ajax({
                type: "POST",
                url: '{{URL::to('traeproductos')}}',
                data: {'arbol' : arbol, 'prfid' : prfid, '_token' : token},
                success: function(response) {
                    var respuesta = JSON.parse(response);
                    //console.log(respuesta);
                    var banner = false;
                    if(respuesta['_productos'].length > 0){
                        var contenido = '';
                        var contador = 1;
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


                            var myarr = registro.ListaAtributos.split(",");
                            var extinto = "";
                            myarr.forEach(function (entry) {
                                //console.log(entry);
                                extinto += " atributo-" + entry;
                            });
                            //console.log( extinto.replace('(','').replace(')', ''));
                            var urlimage = '{{URL::asset('/imagenweb/sku/')}}';
                            var urlficha = '{{ URL::to('/ficha/')}}';
                            var ficha = urlficha + '/' + registro.Sku + '/' + slug(registro.NombreWeb, '-') + '.html';
                            var imagen = urlimage + '/' + $.trim(registro.Foto);
                            contenido += '<div class="product-preview prueba-' + registro.Prf_Id + extinto + '" style="height: 400px;" data-prefijo_id="' + registro.Prf_Id + '">' +
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
                                    '<div class="nombreBusqueda hidden">' + extinto + '</div>' +
                                    '<div class="list_buttons">'+
                                    '<a class="btn btn-mega pull-left" href="#">Add to Cart</a>'+
                                    '</div>'+
                                    '</div>';

                            contador++;

                        });
                        $isotop.append(contenido);
                        recarga();

                        if (!mostrar) {
                            $isotop.hide();
                            //desplegarLineas($('ul#lista-lineas a.linea.activo').data('linea'), $('ul#lista-lineas a.linea.activo').data('id'));
                        }
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
                url: '{{URL::to('traecategorias')}}',
                data: {'arbol': arbol, 'prfid': prfid, '_token': token},
                success: function (response) {
                    var respuesta = JSON.parse(response);
                    //console.log(respuesta);
                    var mostrar = true;
                    var prefactivo = "";
                    if (respuesta['_atributos'].length > 0) {
                        // console.log(respuesta['_atributos']);
                        var contenido = '<h3>Filtros</h3><ul class="expander-list" id="lista-atributos"><form>';

                        $.each(respuesta['_atributos'], function (index, registro) {

                            contenido += '<li class="grupos" data-grupo ="' + registro.GrupoId + '"><span class="name"><span class="expander">-</span> <a href="#">' + registro.Atributo + '</a></span><ul>';
                            $.each(registro['Grupo'], function (index2, valor) {
                                contenido += '<li><input type="checkbox" class="filtros"  name="' + valor.Grp_Id + '" value="atributo-' + valor.Atd_Id + '" multiple="multiple"> ' + valor.Atributo + '</li>';
                            });
                            contenido += '</ul></li>';
                        });

                        contenido += '</form></ul>';
                        $(targetCategorias).html(contenido);

                    } else if (respuesta['_prefijos'].length > 0) {
                        var cantidadpref = respuesta['_prefijos'].length;

                        if (cantidadpref == 1)
                            prefactivo = " activo"
                        var contenido = '<h3>Categorias<a href="#" class="btn btn-xs btn-default pull-right" id="recogerCategorias"><small>ver todas</small></a></h3>' +
                                '<ul class="expander-list" id="lista-categorias">';

                        $.each(respuesta['_prefijos'], function (categoriaId, filtroCategoria) {
                            contenido += '<li class="categorias" data-categoria="' + filtroCategoria.Prf_Id + '">' +
                                    '<span class="name">' +
                                    '<a href="#" class="prefijo' + prefactivo + '" rel="btnPrefijo">' + filtroCategoria.Prefijo + '</a>' +
                                    '</span>' +
                                    '<ul>';
                            $.each(filtroCategoria['_atributos'], function (grupo, filtros) {
                                //console.log(filtroCategoria['_atributos']);
                                contenido += '<li>' +
                                        '<span class="name">' +
                                        '<span class="expander">-</span> ' +
                                        '<a href="#">' + filtros.Atributo + '</a>' +
                                        '</span>' +
                                        '<ul style="padding-left: 20px;">';
                                $.each(filtros['Grupo'], function (filtroId, filtroNombre) {
                                    contenido += '<li rel="filtro">' +
                                            '<input type="checkbox" class="filtros"  name="data[' + filtros.Atributo + '][filtro]" value="atributo-' + filtroNombre.Atd_Id + '" multiple="multiple"> ' + filtroNombre.Atributo +
                                            '</li>';
                                });
                                contenido += '</ul></li>';
                            });


                            contenido += '</ul></li>';
                        });

                        contenido += '</ul>';

                        $(targetCategorias).html(contenido);

                    } else if (respuesta['_lineas'].length > 0) {
                        var contenido = '<h3>Líneas<a href="#" class="btn btn-xs btn-default pull-right" id="lineasTodas"><small>ver todas</small></a></h3><ul class="expander-list" id="lista-lineas">';

                        $.each(respuesta['_lineas'], function (index, linea) {
                            contenido += '<li>' +
                                    '<span class="name">' +
                                    '<a href="#" class="linea" rel="btnLinea" data-linea="' + linea.Linea + '" data-id="' + linea.Atd_Id + '">' + linea.Linea + '</a>' +
                                    '</span>' +
                                    '<ul rel="filtrosLineas">';
                            $.each(linea['_prefijos'], function (grupo, prefijo) {
                                //console.log(filtroCategoria['_atributos']);
                                contenido += '<li ><span class="name"> <a href="#" rel="prefijoFiltroLinea" class="categoria" data-categoria="' + prefijo.Prf_Id + '">' + prefijo.Prefijo + '</a></span></li>';
                            });


                            contenido += '</ul></li>';
                        });

                        contenido += '</ul>';
                        $(targetCategorias).html(contenido);

                        var iconos = '';
                        $.each(respuesta['_lineas'], function (index, linea) {


                            var urlimage = '{{URL::asset('/imagenweb/arbol/')}}';
                            var imagen = urlimage + '/' + $.trim(linea.FotoAtributo);


                            var imagen = 'http://placehold.it/270x270';
                            if (linea.foto) {
                                imagen = imagen;
                            }
                            iconos += '<div class="product-preview" style="height: 400px;">' +
                                    '<div class="preview ">' +
                                    '<a href="#" class="linea" rel="btnLinea" data-linea="' + linea.Linea + '" data-id="' + linea.Atd_Id + '" class="preview-image">' +
                                    '<img class="bordegris" src="' + imagen + '" width="270" height="270" alt="">' +
                                    '</a>' +
                                    '<ul class="product-controls-list right hide-right">' +
                                    '<li class="top-out-small"></li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '<h3 class="title nombreProducto">' +
                                    '<a href="#" class="linea" rel="btnLinea" data-linea="' + linea.Linea + '"><b>' + linea.Linea + '</b></a>' +
                                    '</h3>' +
                                    '</div>';

                        });
                        //console.log(iconos);
                        $('#resultLineas').html(iconos).fadeIn(500);
                        mostrar = false;
                    }

                    //if ($('div#resultProductos').length) {
                    cargarProductos(mostrar);
                    //}

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
                                if ($ul.css("display") == "block") $ul.slideUp("slow");
                                else $ul.slideDown("slow");
                                $(this).html(hide ? "&minus;" : "+");
                                $name.css("font-weight", hide ? "bold" : "normal");
                                hide = !hide
                            })
                        });

                        if (prefactivo != "")
                            $(".expander-list").find("ul").show();
                    }
                }
            });

        }

        $(document).ready(function() {
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


            $(document).on('click','#resultCategorias #recogerCategorias', function(e) {
                e.preventDefault();
                if ($('h3#TituloPrefijo > small').length) {
                    $('h3#TituloPrefijo > small').remove();
                }
                $('#lista-categorias.expander-list > li.categorias').each(function(index,elemento) {
                    $(elemento).children('ul').slideUp("slow");
                    $(elemento).find('a[rel="btnPrefijo"]').removeClass('activo');
                });
                $isotop.isotope({filter: '*'});
            });


            $(document).on('click', '#resultCategorias #lista-lineas a[rel="btnLinea"], #resultLineas a[rel="btnLinea"]', function (e) {
                e.preventDefault();

                var id = $(this).data('id'),
                        linea = $(this).data('linea');
                desplegarLineas(linea, id);
            });

            $(document).on('click','#resultCategorias #lista-categorias.expander-list > li.categorias > span.name > a[rel="btnPrefijo"]', function() {

                var categoria_id = $(this).parents('li.categorias').data('categoria');// categoria seleccionada
                testprefijo = categoria_id;
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

                var filterValue = ".prueba-" + categoria_id;
                filterValue = filterFns[filterValue] || filterValue;

                $isotop.isotope({filter: filterValue});
            });

            $(document).on('change','#resultCategorias #lista-atributos .filtros',function() {
                var isoFilters = [];
                $('#lista-atributos li.grupos').each(function () {
                    $('input.filtros[name="' + $(this).data("grupo") + '"]:checked').each(function () {
                        //console.log($(this).val());
                        //filterValue += "." + $(this).val();
                        isoFilters.push("." + $(this).val());

                    });
                });

                console.log(1);


                var selector = isoFilters.join(', ');
                $isotop.isotope({filter: selector});

                var iso = $isotop.data('isotope');

                var xx = [];
                iso.$filteredAtoms.each(function (i, elem) {
                    var pp = $(elem).find('div.nombreBusqueda.hidden');
                    var pp1 = pp.html().trim().split(" ");
                    pp1.forEach(function (datto) {
                        xx.push(datto);
                    });
                });

                var targetCategorias = $('#resultCategorias');
                var nn = targetCategorias.find('input.filtros');
                for (var i = 0, len = nn.length; i < len; i++) {
                    var au = false;
                    if (!$(nn[i]).prop('checked')) {
                        xx.forEach(function (datto) {
                            //console.log(datto);
                            if (datto == $(nn[i]).val()) {
                                //console.log(datto);
                                au = true;
                            }
                        });

                        if (!au) {
                            //$(nn[i]).hide();
                        }

                    }

                }

                return false;
            });


            $(document).on('change','#resultCategorias #lista-categorias .filtros',function() {
                //console.log(1);

                var categoria_id = $(this).parents('li.categorias').data('categoria');// categoria seleccionada
                console.log(categoria_id);
                var isoFilters = [];
                //isoFilters.push(".prueba-" + testprefijo);
                $('#lista-categorias > li.categorias > ul > li').each(function (a, grupo) {
                    $(grupo).find('input.filtros:checked').each(function (b, atributo) {

                        isoFilters.push("." + $(this).val());
                    });

                });


                //console.log(isoFilters);
                var selector = isoFilters.join(', ');
                console.log(2);
                $isotop.isotope({filter: ".prueba-" + categoria_id + selector});

                return false;
            });



            $(document).on('click', '#lista-lineas ul[rel="filtrosLineas"] a[rel="prefijoFiltroLinea"]', function(e) {
                e.preventDefault();

                var boton = $(this);
                var prefijo = $(boton).data("categoria");
                var linea = $(boton).parents('ul[rel="filtrosLineas"]').siblings('span.name').find('a[rel="btnLinea"]').data('id');

                var filterValue = ".prueba-" + prefijo + ".atributo-" + linea;
                //var filterValue = ".atributo-" + id;
                filterValue = filterFns[filterValue] || filterValue;

                $isotop.isotope({filter: filterValue});

                console.log(prefijo, linea);
            });
        });

        // filter functions
        var filterFns = {
            // show if number is greater than 50
            numberGreaterThan50: function () {
                var number = $(this).find('.number').text();
                return parseInt(number, 10) > 50;
            },
            // show if name ends with -ium
            ium: function () {
                var name = $(this).find('.name').text();
                return name.match(/ium$/);
            }
        };

        String.prototype.replaceAll = function (search, replacement) {
            var target = this;
            return target.split(search).join(replacement);
        };

        // flatten object by concatting values
        function concatValues(obj) {
            var value = '';
            for (var prop in obj) {
                value += obj[prop];
            }
            return value;
        }
    </script>
@stop