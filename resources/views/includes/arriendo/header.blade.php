@php
    $menusPadres = getMenuSuperior(30);
    $cart = new \Steward\Phpcart\Carrito('arriendo');
@endphp

<style>
    .label-cart {
        color: #aaa;
        position: absolute;
        text-align: center;
        top: 8px;
        left: 0;
        width: 100%;
        font-size: 11px;
        display: none;
    }
</style>

<div id="head-desk" class="container hidden-xs hidden-sm">
    <!-- top -->
    <div class="row hidden-xs hidden-sm" style="padding-right:30px">
        <!-- LOGO -->
        <div class="col-md-2" style="height:100px">
            <a style="margin-left:45px" href="{{URL::to('/arriendo')}}">
                <img src="{{URL::asset('/img/logo-top.png')}}" height="75px" class="logo-top" style="margin-top:10px">
            </a>
        </div>
        <!-- END LOGO -->
        <div class="col-md-10">
            <div class="row">
                <ul class="list-inline list-unstyled list-top pull-right">
                    <li><a href="">Lavandería</a></li>
                    <li><a href="">Textil</a></li>
                    <li><a href="">Contacto</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-7"  style="margin-top:-10px;padding-left: 60px; ">
                    {!! Form::open(['method'=>'GET', 'url'=>'/arriendo/categoria/buscador','class'=>'navbar-form','role'=>'buscar'])  !!}
                    <div class="input-group">
                        {{ Form::input('buscar', 'buscar', null, ['class' => 'form-control input-md input-search', 'placeholder' => 'Busque su producto aquí']) }}
                        <div class="input-group-btn">
                            <button  class="btn btn-default btn-md btn-search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-6 col-lg-5" style="margin-top:-10px; padding-right: 0px;">
                    <div class="navbar-secondary-menu pull-right hidden-xs">
                        <!-- login -->
                        <div class="btn-group compact-hidden">
                            @if(checkSesionUsuario())
                                <a href="{{URL::to('/logout')}}" class="btn btn-xs btn-default" id="btnSession"> <span class="icon icon-vcard"></span> Cerrar Sesión </a>
                            @else
                                <a href="{{URL::to('/login')}}" class="btn btn-xs btn-default"> <span class="icon icon-vcard"></span> Login/Registro  </a>
                            @endif

                        </div>
                        <!-- end login -->
                        <!-- carro -->
                        <div id="carroFlotante" class="btn-group pull-right" rel="carroFlotante">
                            @if($cart->count() > 0)
                                <a href="#" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span class="compact-hidden">Carro de compras - <strong>${{number_format($cart->getTotal(), 0, ",", ".")}}</strong></span>
                                    <span aria-hidden="true" class="glyphicon glyphicon-shopping-cart"><span class="label-cart">{{$cart->count()}}</span></span>
                                </a>
                                <div class="dropdown-menu pull-right shoppingcart-box" role="menu"> Su carro de arriendo
                                    <ul class="list">
                                        @foreach($cart->getItems() as $producto)
                                            <li class="item">
                                                <a href="{{ URL::to('/arriendo/ficha/' . $producto->id . '/' . Str::slug($producto->nombre, '-')) }}.html" class="preview-image">
                                                    <img class="preview" src="{{URL::asset('/imagenweb/sku/' . $producto->foto)}}" alt="">
                                                </a>
                                                <div class="description">
                                                    <a href="{{ URL::to('/arriendo/ficha/' . $producto->id . '/' . Str::slug($producto->nombre, '-')) }}.html">
                                                        {{$producto->nombre}}
                                                    </a>
                                                    <strong class="price">{{$producto->cantidad}} x ${{number_format($producto->precio, 0, ",", ".")}}</strong>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="total">Total: <strong>${{number_format($cart->getTotal(), 0, ",", ".")}}</strong></div>
                                    <a href="{{URL::to('/arriendo/checkout')}}" class="btn btn-mega">Confirmar</a>
                                    <div class="view-link"><a href="{{URL::to('/arriendo/carrito')}}">Ver el Cotización </a></div>
                                </div>
                            @else
                                <a href="#" class="btn btn-xs btn-default">
                                    <span class="compact-hidden">Carro de arriendo - <strong>$ 0</strong></span>
                                    <span aria-hidden="true" class="glyphicon glyphicon-shopping-cart">
                                        <span class="label-cart">0</span>
                                    </span>
                                </a>
                            @endif
                        </div>
                        <!-- end carro -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END top -->
    <!-- menu -->
    <div class="row">
        <div class="navbar navbar-steward yamm navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle">
                        <span class="icon-bar" style="background-color: #717171;"></span>
                        <span class="icon-bar" style="background-color: #717171;"></span>
                        <span class="icon-bar" style="background-color: #717171;"></span>
                    </button>
                </div>
                <div id="navbar-collapse-1" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav nav-justified">
                        @foreach($menusPadres['_arbol']['_nivel1'] as $key => $nivel1)
                            <li class="dropdown yamm-fw <?= (($nivel1 == reset($menusPadres['_arbol']['_nivel1']))? ' first':''); ?>">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle princ" <?= ((strlen($nivel1['Nombre']) >= 25) ? 'style="letter-spacing: -1px;"':''); ?>>
                                    {{$nivel1['Nombre']}}
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="grid-demo">
                                        <div class="yamm-content">
                                            <div class="row">
                                                <!-- FE -->
                                                @foreach($nivel1['_nivel2'] as $nivel2)
                                                    <div class="col-xs-6 col-sm-2" style="width:14.2%">
                                                        <h5><a class="name" style="text-decoration: none;" href="#">{{$nivel2['Nombre']}}</a></h5>
                                                        <ul class="list-unstyled">
                                                            @foreach($nivel2['_nivel3'] as $nivel3)
                                                                <li>
                                                                    @if($nivel3['PrfId'] != 0)
                                                                        <a href="{{URL::to('/arriendo/categoria/' . $nivel3['Arbol'] . '/' . $nivel3['PrfId'] . '/' . Str::slug($nivel3['Nombre']) )}}.html">
                                                                            {{$nivel3['Nombre']}}
                                                                        </a>
                                                                    @else
                                                                        <a href="{{URL::to('/arriendo/categoria/' . $nivel3['Arbol'] . '/0/' . Str::slug($nivel3['Nombre']) )}}.html">
                                                                            {{$nivel3['Nombre']}}
                                                                        </a>
                                                                    @endif

                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                            @endforeach
                                            <!--  -->
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @endforeach
                            <li class="dropdown yamm-fw">
                                <a href="" class="dropdown-toggle princ">
                                    Packs Temáticos
                                </a>
                            </li>
                            <li class="dropdown yamm-fw">
                                <a href="" class="dropdown-toggle princ">
                                    Carpas
                                </a>
                            </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END menu -->
</div>
