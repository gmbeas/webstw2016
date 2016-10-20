<section class="container">
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <ul>
                @foreach($banners['_banners']['_bannerGrande'] as $banner)
                    <li data-masterspeed="300" data-slotamount="4" data-transition="fade">
                        @if($banner['Link'] != '')
                            <a href="{{$banner['Link']}}"><img alt="{{$banner['Imagen']}}"
                                                               src="{{Asset::otros($banner['Imagen'])}}" width="100%">
                            </a>
                        @else
                            <img alt="{{$banner['Imagen']}}" src="{{Asset::otros($banner['Imagen'])}}" width="100%">
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
