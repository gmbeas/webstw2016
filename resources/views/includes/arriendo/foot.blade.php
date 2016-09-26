{!! HTML::script('js/jquery-1.10.2.min.js') !!}
{!! HTML::script('js/jquery.easing.1.3.js') !!}
{!! HTML::script('js/jquery-ui-1.10.3.custom.min.js') !!}
{!! HTML::script('js/jquery.ui.touch-punch.min.js') !!}
{!! HTML::script('js/jquery.mousewheel.min.js') !!}
{!! HTML::script('js/bootstrap.min.js') !!}
{!! HTML::script('js/jquery.flexslider.js') !!}
{!! HTML::script('js/owl.carousel.js') !!}
{!! HTML::script('js/jquery.jcarousel.min.js') !!}
{!! HTML::script('js/jquery.isotope.min.js') !!}
{!! HTML::script('js/jquery.parallax.js') !!}
{!! HTML::script('js/jquery.fancybox.js') !!}
{!! HTML::script('js/jquery.inview.js') !!}
{!! HTML::script('js/hoverIntent.js') !!}
{!! HTML::script('js/superfish.js') !!}
{!! HTML::script('js/supersubs.js') !!}
{!! HTML::script('js/jquery.plugin.js') !!}
{!! HTML::script('js/jquery.countdown.js') !!}
{!! HTML::script('js/jquery.carouFredSel-6.2.1-packed.js') !!}
{!! HTML::script('js/megatron.js') !!}
{!! HTML::script('rs-plugin/js/jquery.themepunch.tools.min.js') !!}
{!! HTML::script('rs-plugin/js/jquery.themepunch.revolution.min.js') !!}
{!! HTML::script('js/cloudzoom.js') !!}
{!! HTML::script('js/jquery.printarea.js') !!}
{!! HTML::script('js/funciones.js') !!}

<script>
    $(function() {
        window.prettyPrint && prettyPrint()
        $(document).on('click', '.yamm .dropdown-menu', function(e) {
            e.stopPropagation()
        });
    });
    $(document).ready(function() {
        $('#carroFlotante').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
        }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
        });
    });

    $('ul.nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });

    jQuery(document).ready(function() {
        jQuery('.fullwidthbanner').show().revolution(
                {
                    dottedOverlay:"none",
                    delay:16000,
                    startwidth:1170,
                    startheight:500,
                    hideThumbs:200,

                    thumbWidth:100,
                    thumbHeight:50,
                    thumbAmount:5,

                    navigationType:"none",
                    navigationArrows:"solo",
                    navigationStyle:"none",

                    touchenabled:"on",
                    onHoverStop:"on",

                    swipe_velocity: 0.7,
                    swipe_min_touches: 1,
                    swipe_max_touches: 1,
                    drag_block_vertical: false,

                    parallax:"mouse",
                    parallaxBgFreeze:"on",
                    parallaxLevels:[7,4,3,2,5,4,3,2,1,0],

                    keyboardNavigation:"off",

                    navigationHAlign:"center",
                    navigationVAlign:"bottom",
                    navigationHOffset:0,
                    navigationVOffset:20,

                    soloArrowLeftHalign:"left",
                    soloArrowLeftValign:"center",
                    soloArrowLeftHOffset:20,
                    soloArrowLeftVOffset:0,

                    soloArrowRightHalign:"right",
                    soloArrowRightValign:"center",
                    soloArrowRightHOffset:20,
                    soloArrowRightVOffset:0,

                    shadow:0,
                    fullWidth:"off",
                    fullScreen:"off",

                    spinner:"off",

                    stopLoop:"off",
                    stopAfterLoops:-1,
                    stopAtSlide:-1,

                    shuffle:"off",

                    autoHeight:"off",
                    forceFullWidth:"off",



                    hideThumbsOnMobile:"off",
                    hideNavDelayOnMobile:1500,
                    hideBulletsOnMobile:"off",
                    hideArrowsOnMobile:"off",
                    hideThumbsUnderResolution:0,
                    hideTimerBar:"on",
                    hideSliderAtLimit:0,
                    hideCaptionAtLimit:0,
                    hideAllCaptionAtLilmit:0,
                    startWithSlide:0,
                    fullScreenOffsetContainer: ".navbar"
                });
    });	//ready

</script>