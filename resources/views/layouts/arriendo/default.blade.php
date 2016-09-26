<!DOCTYPE html>
<html lang="es">
<head>
    @include('includes.arriendo.head')
    @yield('css')
</head>
<body id="arriendoBody" class="responsive">
<div id="outer">
    <div id="background_wrap"></div>
    <div class="loader">
        <div class="bubblingG"> <span id="bubblingG_1"> </span> <span id="bubblingG_2"> </span> <span id="bubblingG_3"> </span> </div>
    </div>

    <div id="outer-canvas">
        <!-- Header -->
        @include('includes.arriendo.header')
        <!-- //end header -->

        @yield('content')

        <div class="container">
            @include('includes.arriendo.footer')
        </div>
        <div id="outer-overlay"></div>
    </div>
</div>

@include('includes.arriendo.foot')
@yield('javascript')
</body>
</html>