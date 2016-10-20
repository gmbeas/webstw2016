<style>
    #registroCheckoutForm .error, #registroLoginForm .error, #registroCheckoutArriendoForm .error {
        border-color: #c00232;
    }
</style>

<section class="container-with-large-icon login-form">
    <div class="large-icon"></div>
    <div class="wrap">
        <h3>COMPRAR COMO INVITADO</h3>
        <p>Puede comprar sin registrarse, si no tiene una cuenta creada.</p>
        <div class="form-group">
            <button class="btn btn-mega" onclick="location.href='{{URL::to('/checkout/1')}}';">CONTINUAR SIN REGISTRO
            </button>
        </div>

    </div>
</section>