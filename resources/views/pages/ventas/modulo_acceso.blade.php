<style>
    #registroCheckoutForm .error, #checkoutForm .error, #loginForm .error {
        border-color: #c00232;
    }
</style>

<section class="container-with-large-icon login-form">
    <div class="large-icon"></div>
    <div class="wrap">
        <h3>¿YA ESTÁ REGISTRADO?</h3>
        {{ Form::open(array('url' => '/login', 'class' => 'validar-formulario')) }}
        <div class="form-group">
            <label for="text">Rut </label>
            {{ Form::input('rutcliente', 'rutcliente', null, ['class' => 'form-control', 'placeholder' => 'Ej: 11111111-1']) }}
        </div>
        <div class="form-group">
            <label for="text">Contraseña </label>
            {{ Form::password('password', ['class' => 'form-control', 'id' => 'password']) }}
        </div>
        <div class="form-link">
            ¿Olvidó su contraseña?
        </div>
        <button type="submit" id="btnLogin" class="btn btn-mega" >Ingresar</button>
        {{ Form::close() }}
    </div>
</section>

