<style>
    #registroCheckoutForm .error, #registroLoginForm .error, #registroCheckoutArriendoForm .error {
        border-color: #c00232;
    }
</style>

<section class="container-with-large-icon login-form">
    <div class="large-icon"></div>
    <div class="wrap">
        <h3>CREAR UNA CUENTA</h3>
        <p>Escriba su rut para crear su cuenta</p>
        {{ Form::open(array('url' => '/validaregistro', 'class' => 'validar-formulario')) }}
        <div class="form-group">
            {{ Form::input('rutcliente', 'rutcliente', null, ['class' => 'form-control', 'placeholder' => 'Ej: 11111111-1', 'id' => 'rutcliente']) }}
        </div>
        <button class="btn btn-mega" onclick="location.href='#';">CONTINUAR</button>
        {{ Form::close() }}

    </div>
</section>