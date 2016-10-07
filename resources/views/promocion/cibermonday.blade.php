@extends('layouts.ventas.default')

@section('titulo', 'CiberMonday')

@section('css')

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
        <!-- Options panel -->
        <div class="options-panel row">
            <div class="col-xs-6 col-md-4 col-lg-3 hidden-sm">
                <h3>PRECIO</h3>
                <div class="slider-range">
                    <div class="control"></div>
                    <div class="min">$<span class="value">1.000</span></div>
                    <div class="max">$<span class="value">45.000</span></div>
                </div>
            </div>
            <div class="clearfix visible-md visible-sm"></div>
            <div class="divider-xs visible-xs"></div>
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 hidden-xs">
                <h3>CATEGORIAS</h3>
                <div class="btn-group btn-select"><a href="#" class="btn btn-default btn-xs dropdown-toggle"
                                                     data-toggle="dropdown"> <span class="value"><span
                                    class="m-icon m-icon-shorts"></span> Shorts</span> <span class="caret min"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><span class="m-icon m-icon-dress"></span>Dresses</a></li>
                        <li><a href="#"><span class="m-icon m-icon-shirts"></span>Shirts</a></li>
                        <li><a href="#"><span class="m-icon m-icon-coats"></span>Coats</a></li>
                        <li><a href="#"><span class="m-icon m-icon-jackets"></span>Jackets</a></li>
                        <li><a href="#"><span class="m-icon m-icon-shorts"></span> Shorts</a></li>
                        <li><a href="#"><span class="m-icon m-icon-jeans"></span>Jeans</a></li>
                        <li><a href="#"><span class="m-icon m-icon-skirts"></span>Skirts</a></li>
                        <li><a href="#"><span class="m-icon m-icon-lingerie"></span>Lingerie</a></li>
                        <li><a href="#"><span class="m-icon m-icon-tops"></span>Tops</a></li>
                    </ul>
                </div>
            </div>

            <div class="divider-xs visible-sm"></div>
            <div class="col-sm-6 visible-sm">
                <h3>PRICE</h3>
                <div class="slider-range">
                    <div class="control"></div>
                    <div class="min">$<span class="value">19</span></div>
                    <div class="max">$<span class="value">3000</span></div>
                </div>
            </div>
        </div>
        <!-- //end Options panel -->


        <!-- Products list -->
        <div class="row products-list">
            <div class="product-preview ">
                <div class="preview animate scale">
                    <a href="product_default.html" class="preview-image">
                        <img class="img-responsive animate scale"
                             src="http://localhost:8080/webstw/public/imagenweb/sku/020001848_b1.jpg" width="270"
                             height="328" alt="">
                    </a>
                    <ul class="product-controls-list right">
                        <li><span class="label label-sale">OFERTA</span></li>
                        <li><span class="label">-20%</span></li>
                    </ul>

                </div>
                <h3 class="title"><a href="#">Chaqueta</a></h3>

                <span class="price old">$54.220</span>
                <span class="price new">$44.950</span>
            </div>

            <div class="product-preview ">
                <div class="preview animate scale">
                    <a href="product_default.html" class="preview-image">
                        <img class="img-responsive animate scale"
                             src="http://localhost:8080/webstw/public/imagenweb/sku/020001848_b1.jpg" width="270"
                             height="328" alt="">
                    </a>
                    <ul class="product-controls-list right">
                        <li><span class="label label-sale">OFERTA</span></li>
                        <li><span class="label">-20%</span></li>
                    </ul>

                </div>
                <h3 class="title"><a href="#">Chaqueta</a></h3>

                <span class="price old">$54.220</span>
                <span class="price new">$44.950</span>
            </div>

            <div class="product-preview ">
                <div class="preview animate scale">
                    <a href="product_default.html" class="preview-image">
                        <img class="img-responsive animate scale"
                             src="http://localhost:8080/webstw/public/imagenweb/sku/020001848_b1.jpg" width="270"
                             height="328" alt="">
                    </a>
                    <ul class="product-controls-list right">
                        <li><span class="label label-sale">OFERTA</span></li>
                        <li><span class="label">-20%</span></li>
                    </ul>

                </div>
                <h3 class="title"><a href="#">Chaqueta</a></h3>

                <span class="price old">$54.220</span>
                <span class="price new">$44.950</span>
            </div>

            <div class="product-preview ">
                <div class="preview animate scale">
                    <a href="product_default.html" class="preview-image">
                        <img class="img-responsive animate scale"
                             src="http://localhost:8080/webstw/public/imagenweb/sku/020001848_b1.jpg" width="270"
                             height="328" alt="">
                    </a>
                    <ul class="product-controls-list right">
                        <li><span class="label label-sale">OFERTA</span></li>
                        <li><span class="label">-20%</span></li>
                    </ul>

                </div>
                <h3 class="title"><a href="#">Chaqueta</a></h3>

                <span class="price old">$54.220</span>
                <span class="price new">$44.950</span>
            </div>

            <div class="product-preview ">
                <div class="preview animate scale">
                    <a href="product_default.html" class="preview-image">
                        <img class="img-responsive animate scale"
                             src="http://localhost:8080/webstw/public/imagenweb/sku/020001848_b1.jpg" width="270"
                             height="328" alt="">
                    </a>
                    <ul class="product-controls-list right">
                        <li><span class="label label-sale">OFERTA</span></li>
                        <li><span class="label">-20%</span></li>
                    </ul>

                </div>
                <h3 class="title"><a href="#">Chaqueta</a></h3>

                <span class="price old">$54.220</span>
                <span class="price new">$44.950</span>
            </div>

            <div class="product-preview ">
                <div class="preview animate scale">
                    <a href="product_default.html" class="preview-image">
                        <img class="img-responsive animate scale"
                             src="http://localhost:8080/webstw/public/imagenweb/sku/020001848_b1.jpg" width="270"
                             height="328" alt="">
                    </a>
                    <ul class="product-controls-list right">
                        <li><span class="label label-sale">OFERTA</span></li>
                        <li><span class="label">-20%</span></li>
                    </ul>

                </div>
                <h3 class="title"><a href="#">Chaqueta</a></h3>

                <span class="price old">$54.220</span>
                <span class="price new">$44.950</span>
            </div>

            <div class="product-preview ">
                <div class="preview animate scale">
                    <a href="product_default.html" class="preview-image">
                        <img class="img-responsive animate scale"
                             src="http://localhost:8080/webstw/public/imagenweb/sku/020001848_b1.jpg" width="270"
                             height="328" alt="">
                    </a>
                    <ul class="product-controls-list right">
                        <li><span class="label label-sale">OFERTA</span></li>
                        <li><span class="label">-20%</span></li>
                    </ul>

                </div>
                <h3 class="title"><a href="#">Chaqueta</a></h3>

                <span class="price old">$54.220</span>
                <span class="price new">$44.950</span>
            </div>

            <div class="product-preview ">
                <div class="preview animate scale">
                    <a href="product_default.html" class="preview-image">
                        <img class="img-responsive animate scale"
                             src="http://localhost:8080/webstw/public/imagenweb/sku/020001848_b1.jpg" width="270"
                             height="328" alt="">
                    </a>
                    <ul class="product-controls-list right">
                        <li><span class="label label-sale">OFERTA</span></li>
                        <li><span class="label">-20%</span></li>
                    </ul>

                </div>
                <h3 class="title"><a href="#">Chaqueta</a></h3>

                <span class="price old">$54.220</span>
                <span class="price new">$44.950</span>
            </div>

            <div class="product-preview ">
                <div class="preview animate scale">
                    <a href="product_default.html" class="preview-image">
                        <img class="img-responsive animate scale"
                             src="http://localhost:8080/webstw/public/imagenweb/sku/020001848_b1.jpg" width="270"
                             height="328" alt="">
                    </a>
                    <ul class="product-controls-list right">
                        <li><span class="label label-sale">OFERTA</span></li>
                        <li><span class="label">-20%</span></li>
                    </ul>

                </div>
                <h3 class="title"><a href="#">Chaqueta</a></h3>

                <span class="price old">$54.220</span>
                <span class="price new">$44.950</span>
            </div>

            <div class="product-preview ">
                <div class="preview animate scale">
                    <a href="product_default.html" class="preview-image">
                        <img class="img-responsive animate scale"
                             src="http://localhost:8080/webstw/public/imagenweb/sku/020001848_b1.jpg" width="270"
                             height="328" alt="">
                    </a>
                    <ul class="product-controls-list right">
                        <li><span class="label label-sale">OFERTA</span></li>
                        <li><span class="label">-20%</span></li>
                    </ul>

                </div>
                <h3 class="title"><a href="#">Chaqueta</a></h3>

                <span class="price old">$54.220</span>
                <span class="price new">$44.950</span>
            </div>

            <div class="product-preview ">
                <div class="preview animate scale">
                    <a href="product_default.html" class="preview-image">
                        <img class="img-responsive animate scale"
                             src="http://localhost:8080/webstw/public/imagenweb/sku/020001848_b1.jpg" width="270"
                             height="328" alt="">
                    </a>
                    <ul class="product-controls-list right">
                        <li><span class="label label-sale">OFERTA</span></li>
                        <li><span class="label">-20%</span></li>
                    </ul>

                </div>
                <h3 class="title"><a href="#">Chaqueta</a></h3>

                <span class="price old">$54.220</span>
                <span class="price new">$44.950</span>
            </div>

            <div class="product-preview ">
                <div class="preview animate scale">
                    <a href="product_default.html" class="preview-image">
                        <img class="img-responsive animate scale"
                             src="http://localhost:8080/webstw/public/imagenweb/sku/020001848_b1.jpg" width="270"
                             height="328" alt="">
                    </a>
                    <ul class="product-controls-list right">
                        <li><span class="label label-sale">OFERTA</span></li>
                        <li><span class="label">-20%</span></li>
                    </ul>

                </div>
                <h3 class="title"><a href="#">Chaqueta</a></h3>

                <span class="price old">$54.220</span>
                <span class="price new">$44.950</span>
            </div>


        </div>
        <!-- //end Products list -->
    </section>
@stop

@section('javascript')

@stop