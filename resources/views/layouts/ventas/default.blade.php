<!DOCTYPE html>
<html lang="es">
    <head>
        @include('includes.ventas.head')
        @yield('css')
</head>
<body class="responsive">
<div id="outer">
    <div id="background_wrap"></div>
    <div class="loader">
        <div class="bubblingG"> <span id="bubblingG_1"> </span> <span id="bubblingG_2"> </span> <span id="bubblingG_3"> </span> </div>
    </div>

    <div id="outer-canvas">

        <!-- Header -->
        @include('includes.ventas.header')
        <!-- //end header -->

        @yield('content')

        <div class="container">
            @include('includes.ventas.footer')
        </div>
        <div id="outer-overlay"></div>
    </div>
</div>

@include('includes.ventas.foot')

@yield('javascript')
@include('sweet::alert')
</body>
</html>