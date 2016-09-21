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
            {{ Form::input('rutcliente', 'rutcliente', null, ['class' => 'form-control', 'placeholder' => 'Ej: 11111111-1', 'id' => 'rutcliente']) }}
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

@section('javascript')
    <script>
        $(document).on('change', '#rutcliente', function() {
            var target = $(this),
                    rut = $(this).val();
            if (rut.length > 1) {
                var newRut = '',
                        dv = '';
                for (x = 0;x < rut.length; x++) {
                    if (x == (rut.length-1)) {
                        dv = rut[x];
                    } else if (! isNaN(rut[x])) {
                        newRut+=rut[x];
                    }
                }
                $(target).val(format(newRut)+'-'+dv);
            }
        });

        function format(input) {
            var num = input;
            if(!isNaN(num)) {
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                num = num.split('').reverse().join('').replace(/^[\.]/,'');
                return num
            } else {
                alert('Solo se permiten numeros');
            }
        }

    </script>
@stop
