@php
    $masvendidos = getMasVendidos(30);
@endphp
<section class="content">
    <div class="row">
        <div class="col-sm-6 col-md-3 col-lg-3">

            <h3 class="titulo_tipos">MÁS ARRENDADOS</h3>
            <div class="products-widget jcarousel-skin-previews vertical">
                <ul class="slides">
                    @foreach($masvendidos['_vendidoshome'] as $producto)
                        <li>
                            <div class="product">
                                <a href="{{ URL::to('/arriendo/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html" class="preview-image">
                                    <img class="img-responsive " src="{{URL::asset('/imagenweb/sku/' . $producto['Sku'] . '_b1.jpg')}}" alt="">
                                </a>
                                <p class="name">
                                    <a href="{{ URL::to('/arriendo/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html" class="preview-image">
                                        {{$producto['NombreWeb']}}
                                    </a>
                                </p>
                                <span class="rating"> </span> <span class="price">${{number_format($producto['PrecioUnidadBrutoNormal'], 0, ",", ".")}}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">

            <h3 class="titulo_tipos">RECIÉN LLEGADOS</h3>
            <div class="products-widget jcarousel-skin-previews vertical">
                <ul class="slides">
                    @foreach($agrupados['_agrupados'] as $producto)
                        @if($producto['Tipo'] == 'LAN')
                            <li>
                                <div class="product">
                                    <a href="{{ URL::to('/arriendo/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html" class="preview-image">
                                        <img class="img-responsive scale" src="{{URL::asset('/imagenweb/sku/' . $producto['Sku'] . '_b1.jpg')}}" alt="">
                                    </a>
                                    <p class="name">
                                        <a href="{{ URL::to('/arriendo/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html" class="preview-image">
                                            {{$producto['NombreWeb']}}
                                        </a>
                                    </p>
                                    <span class="rating"> </span> <span class="price">${{number_format($producto['PrecioUnidadBrutoNormal'], 0, ",", ".")}}</span>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

        </div>
        <section class="col-sm-6 col-md-3 col-lg-3 slider-products  module">

            <h3 class="titulo_tipos">OFERTA</h3>
            <div class="row">
                <div class="product-carousel owl-carousel owl-theme">
                    <div class="owl-wrapper-outer">
                        <div class="owl-wrapper">
                            <div class="owl-item" >
                                <div class="item">
                                    <div class="product-preview modulo-oferta">
                                        @foreach($agrupados['_agrupados'] as $producto)
                                            @if($producto['Tipo'] == 'OFE')

                                                <div class="preview ">
                                                    <a href="{{ URL::to('/arriendo/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html" class="preview-image">
                                                        <img class="img-responsive" src="{{URL::asset('/imagenweb/sku/' . $producto['Sku'] . '_b1.jpg')}}"  width="100%" alt="">
                                                    </a>
                                                    <ul class="product-controls-list">
                                                        <li><span class="label label-new hidden">NUEVO</span></li>
                                                    </ul>
                                                </div>
                                                <h3 class="title">
                                                    <a href="{{ URL::to('/arriendo/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html">
                                                        {{$producto['NombreWeb']}}
                                                    </a>
                                                </h3>
                                                <span class="price old hidden">${{number_format($producto['PrecioUnidadBrutoNormal'], 0, ",", ".")}}</span>
                                                <span class="price new">${{number_format($producto['PrecioUnidadBrutoNormal'], 0, ",", ".")}}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <div class="col-sm-6 col-md-3 col-lg-3">
            <h3 class="titulo_tipos" style="font-size: 1.5em; letter-spacing: -2px; font-weight: 600;">FAVORITOS DEL BANQUETERO</h3>
            <div class="products-widget jcarousel-skin-previews vertical">
                <ul class="slides">
                    @foreach($agrupados['_agrupados'] as $producto)
                        @if($producto['Tipo'] == 'FCF')
                            <li>
                                <div class="product">
                                    <a href="{{ URL::to('/arriendo/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html"class="preview-image">
                                        <img class="img-responsive  " src="{{URL::asset('/imagenweb/sku/' . $producto['Sku'] . '_b1.jpg')}}" alt="">
                                    </a>
                                    <p class="name">
                                        <a href="{{ URL::to('/arriendo/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html" class="preview-image">
                                            {{$producto['NombreWeb']}}
                                        </a>
                                    </p>
                                    <span class="rating"> </span> <span class="price">${{number_format($producto['PrecioUnidadBrutoNormal'], 0, ",", ".")}}</span>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>