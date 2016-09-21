@php
    $marcas = getMarcas();
@endphp

<!-- MARCAS -->
<style>
    .carouFredSel .slides li {
        height: 150px !important;
    }
</style>
<section class="container content-row">

    <h3>Marcas</h3>
    <div class="brands carouFredSel row">
        <div class="carouFredSel-controls">
            <div class="carouFredSel-buttons">
                <a id="brands-carousel-prev" class="prev" href="#"></a><a id="brands-carousel-next" class="next" href="#"></a>
            </div>
        </div>
        <div class="brands-carousel">
            <ul class="slides">
                @foreach($marcas['_marcas'] as $marca)
                    <li>
                        <a href="">
                            <img src="{{URL::asset('/imagenweb/arbol/' . $marca['FotoAtributo'])}}" alt="{{$marca['FotoAtributo']}}" height="120">
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</section>
<!-- END MARCAS -->
