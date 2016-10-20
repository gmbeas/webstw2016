<section class="container content slider-products">
    <h3>Productos Destacados</h3>
    <!-- Products list -->
    <div class="row">
        <div class="product-carousel">
            @foreach($agrupados['_agrupados'] as $producto)
                @if($producto['Tipo'] == 'DES')
                    <div class="item">
                        <div class="product-preview">
                            <div class="preview">
                                <a href="{{ URL::to('/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html" class="preview-image">
                                    <img class="img-responsive" src="{{Asset::skus($producto['Sku'] . '_b1.jpg')}}"
                                         alt="">
                                </a>
                                <ul class="product-controls-list right">
                                    <li><span class="label label-sale hidden">SALE</span></li>
                                    <li><span class="label hidden">-<?=rand(20,40);?>%</span></li>
                                </ul>
                            </div>
                            <h3 class="title"><a href="{{ URL::to('/ficha/' . $producto['Sku'] . '/' . Str::slug($producto['NombreWeb'], '-')) }}.html">{{$producto['NombreWeb']}}</a></h3>
                            <span class="price new">${{number_format($producto['PrecioUnidadBrutoNormal'], 0, ",", ".")}}</span><br>
                            <span class="price hidden">${{number_format($producto['PrecioUnidadBrutoNormal'], 0, ",", ".")}}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <!-- product view ajax container -->
        <div class="product-view-ajax-container"> </div>
        <!-- //end product view ajax container -->
    </div>
    <!-- //end Products list -->
    <!-- Product view compact -->
    <div class="product-view-ajax">
        <div class="ajax-loader progress progress-striped active">
            <div class="progress-bar progress-bar-danger" role="progressbar"></div>
        </div>
        <div class="layar"></div>
        <div class="product-view-container"> </div>
    </div>
    <!-- //end Product view compact -->
</section>