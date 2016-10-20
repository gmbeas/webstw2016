@php
    $sucursales = array(
            array(
                'nombre' => 'Huechuraba',
                'direccion' => '<b>Horario</b><br/>Lunes a viernes de 9 a 19hrs <br/>Sábados de 9 a 15hrs<br/><b>Ubicación</b><br/>Américo Vespucio Norte 0655',
                'comuna' => 'Huechuraba',
                'ciudad' => 'Santiago',
                'telefono' => 'Teléfono: +56 22756 6000',
                'contacto' => '',
                'iframe' => 'https://www.google.com/maps/embed/v1/place?q=Av+Américo+Vespucio+0655,+Huechuraba,+Santiago,+Chile&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU'
            ),
            array(
                'nombre' => 'Vitacura',
                'direccion' => '<b>Horario</b><br/>Lunes a viernes de 9 a 19hrs <br/>Sábados de 9 a 15hrs<br/><b>Ubicación</b><br/>Av. Padre Hurtado Norte 1225',
                'comuna' => 'Vitacura',
                'ciudad' => 'Santiago',
                'telefono' => 'Teléfono: +56 22756 6080',
                'contacto' => '',
                'iframe' => 'https://www.google.com/maps/embed/v1/place?q=Av+Padre+Hurtado+1225,+Vitacura,+Santiago,+Chile&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU'
            ),
            array(
                'nombre' => 'Santiago Centro',
                'direccion' => '<b>Horario</b><br/>Lunes a viernes de 9 a 14hrs - 15 a 19hrs<br/>Sábados de 9 a 15hrs<br/><b>Ubicación</b><br/>San Pablo 1335',
                'comuna' => 'Santiago',
                'ciudad' => 'Santiago',
                'telefono' => 'Teléfono: +56 22756 6070',
                'contacto' => '',
                'iframe' => 'https://www.google.com/maps/embed/v1/place?q=San+Pablo+1335,+Santiago,+Santiago,+Chile&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU'
            ),
            array(
                'nombre' => 'Viña del Mar',
                'direccion' => '<b>Horario</b><br/>Lunes a viernes de 9 a 14hrs - 15 a 19hrs<br/>Sábados de 9 a 15hrs<br/><b>Ubicación</b><br/>Av. 1 Oriente 790 (Esquina 9 Norte)',
                'comuna' => 'Viña del Mar',
                'ciudad' => '',
                'telefono' => 'Teléfono: +56 22956 6112',
                'contacto' => '',
                'iframe' => 'https://www.google.com/maps/embed/v1/place?q=Av+1+Oriente+790,+Viña+del+Mar,+Chile&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU'
            )
        );
@endphp
<footer>
    <section class="footer-navbar">
        <div class="container content nopad-xs">
            <div class="row">
                @foreach($sucursales as $sucursal)
                    <div class="col-xs-6 col-md-3 collapsed-block">
                        <h3>
                            <?= $sucursal['nombre']; ?>
                        </h3>
                        <ul class="menu">
                            <li style="padding: 0;">
                                <?= ((isset($sucursal['direccion']) && $sucursal['direccion']) ? $sucursal['direccion']:''); ?>
                            </li>
                            <li style="padding: 0;">
                                <?= ((isset($sucursal['comuna']) && $sucursal['comuna']) ? $sucursal['comuna']:''); ?><?= ((isset($sucursal['ciudad']) && $sucursal['ciudad']) ? ', '.$sucursal['ciudad']:''); ?>
                            </li>
                            <li style="padding: 0;">
                                <?= ((isset($sucursal['telefono']) && $sucursal['telefono']) ? $sucursal['telefono']:''); ?>
                            </li>
                            <li style="padding: 0;">
                                <?= ((isset($sucursal['contacto']) && $sucursal['contacto']) ? $sucursal['contacto']:''); ?>
                            </li>
                            <li style="padding: 0; margin-top: 20px;">
                                <a href="#modalMaps" class="btn btn-xs btn-default" title="ver mapa" data-toggle="modal" data-target="#modalMaps" data-backdrop="static" rel="marcadorMapa" data-iframe="<?= $sucursal['iframe']; ?>" data-nombre="<?= $sucursal['nombre']; ?>" data-direccion="<?= $sucursal['direccion'].' - '.$sucursal['comuna']; ?>">
                                    <i class="glyphicon glyphicon-globe"></i> Ver mapa
                                </a>
                            </li>
                        </ul>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <section class="footer-bottom-block container">
        <div class="row">
            <div class="col-sm-8 col-md-8 copyright-text"> &copy; 2015 <a href="#">STEWARD</a>. Todos los derechos reservados. </div>

            <div class="col-sm-4 col-md-4">
                <ul class="payment-list pull-right">
                    <li><img src="{{Asset::img('web-pay.png')}}"></li>
                </ul>
            </div>
        </div>
    </section>
</footer>

<!-- MODAL -->
<div class="modal fade" id="modalMaps" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" rel="titulo">Modal title</h4>
            </div>
            <div class="modal-body">
                <div id="map-canvas" style="height: 350px;"></div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
