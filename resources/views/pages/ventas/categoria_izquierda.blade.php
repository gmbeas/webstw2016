
    <style>
        .resaltado{
            font-weight: bold;
        }
        .noMostrar {
            display: none !important;
        }
    </style>



    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <div class="section-divider" style="padding-top: 0px;padding-bottom: 0px;"></div>
    <section id="resultCategorias" data-arbol="{{Request::segment(2)}}" data-prfid="{{Request::segment(3)}}"></section>


