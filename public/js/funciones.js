/*
 *
 * Andain, Desarrollo y Diseño Web
 * http://www.andain.cl/ <contacto@andain.cl>
 */

//<![CDATA[
//------------------------ JQUERY
jQuery(document).ready(function()
{
	// lastModalId, se le envia un modal Id, para simular un toggle en $.alerta();
	var lastModalId = '';
	//------------------------ Debug function
	var pr = function (Data) {
		console.debug(Data);
		// throw null;
	}

	//------------------------ Extends Jquery.
	jQuery.fn.FormatRut = function(newOptions){
		var defaults = {
			bind   : 'change',
			format : true
		};

		var options = $.extend(defaults, newOptions);

		var format = function(Rut, digitoVerificador) {
			var sRut = new String(Rut);
	        var sRutFormateado = '';

	        sRut = unFormat(sRut);

	        if( ! digitoVerificador){
	        	var sDV = sRut.charAt(sRut.length-1);
	            sRut = sRut.substring(0, sRut.length-1);
	        }

	        while( sRut.length > 3 ) {
	            sRutFormateado = '.' + sRut.substr(sRut.length - 3) + sRutFormateado;
	            sRut = sRut.substring(0, sRut.length - 3);
	        }

	        sRutFormateado = sRut + sRutFormateado;

	        if(sRutFormateado != '' && digitoVerificador) {
	            sRutFormateado += '-' + sDV;
	        } else if(digitoVerificador) {
	            sRutFormateado += sDV;
	        }

	        return sRutFormateado + '-' + sDV; 
		};

		var unFormat = function(rut) {
			while( rut.indexOf('.') != -1 ) {
				rut = rut.replace('.', '');
			}

			while( rut.indexOf('-') != -1 ) {
				rut = rut.replace('-', '');
			}

			return rut;
		}

		var validate = function(crut) {
			dv = crut.charAt( crut.length -1 );
			crut = unFormat(crut);

			largo = crut.length;

			if ( largo < 2 )   {   
				return false; 
			}

			if(largo > 2) {
				rut = crut.substring(0, largo - 1);
			} else {   
				rut = crut.charAt(0);
			}

			if(rut == null || dv == null) {
				return 0;
			}

			dvr = getDigito(rut);

			if (dvr != dv.toLowerCase()) {   
				return false;
			}

			return true;
		}

		var getDigito = function(rut) {
			var dvr = '0';
			var suma = 0;
			var mul  = 2;
			var max = rut.length - 1;

			for( i = max; i >= 0; --i ) { 
				suma = suma + rut.charAt(i) * mul;    
				if( mul == 7 ) {
				  mul = 2;
				} else {         
				  ++mul;
				} 
			}

			res = suma % 11;

			if( res == 1 ) {
				return 'k';
			} else if( res == 0 ) {   
				return '0';
			} else {   
				return 11 - res;
			}
		}

		return this.each(function(){
			jQuery(this).bind(defaults.bind, function(){

				var rut = jQuery(this).val();

				if( ! rut ) {
					return false;
				}

				jQuery(this).val( format(rut) );

				if( validate(rut) == false ) {
					jQuery(this).focus();
					alert('Rut inválido.');
					return false;
				}
	        });
		});
	};

	jQuery.fn.verificarRut = function(){
		if( $.trim(jQuery(this).val()) == 0 || jQuery.type(jQuery(this).val()) != 'string') {
			return false;
		}
		var rut = $.trim(jQuery(this).val());
		var dvr = '0';
		var suma = 0;
		var mul  = 2;
		var max = rut.length - 1;

		for( i = max; i >= 0; --i ) { 
			suma = suma + rut.charAt(i) * mul;    
			if( mul == 7 ) {
			  mul = 2;
			} else {         
			  ++mul;
			} 
		}

		res = suma % 11;

		if( res == 1 ) {
			return 'K';
		} else if( res == 0 ) {   
			return '0';
		} else {   
			return 11 - res;
		}
	}

	jQuery.fn.isEmail = function(){
		if( $.trim(jQuery(this).val()) == 0 || jQuery.type(jQuery(this).val()) != 'string')
		{
			return false;
		}

		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  	return regex.test(jQuery(this).val());
	}
	
	jQuery.alerta = function(Mensaje){
		if( Mensaje && jQuery('#alerta-sistema').html() )
		{
			jQuery('#alerta-sistema .modal-body').html(Mensaje);
			
			jQuery(lastModalId).modal('hide');
			
			jQuery('#alerta-sistema').modal({
				show: true,
				backdrop: true,
				keyboard: true
			}).on('hidden.bs.modal', function(){
				jQuery(lastModalId).modal('show');
			});
		}

		return false;
	}

	jQuery.confirmar = function(Mensaje, Url){
		if( typeof bootbox == 'undefined' ) {
			$.getScript(webroot + 'vendors/bootbox/js/bootbox.min.js')
				.done(function(script, textStatus) {
					bootbox.confirm(Mensaje, function(result) {
						if( result === true )
						{
							window.location.replace(Url);
						}
			        });
				})
				.fail(function(jqxhr, settings, exception) {
					pr('error:');
					pr('Can\'t load bootbox.js from server.');
					pr('Triggered ajaxError handler.');
			});
		} else {
			bootbox.confirm(Mensaje, function(result) {
				if( result === true )
				{
					window.location.replace(Url);
				}
	        });
		}

        return false;
	}

	jQuery.formatNumber = function(Number){
		return Number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
	}

	// Boton 'Enviar' dentro de randoms modals que contengan formularios------------------------ 
	// Envia cualquier modal con sus respectivas validaciones para inputs 'required'
	// jQuery('.modal-enviar').click(function(Event){
	// 	Event.preventDefault;

	// 	var access 		= true,
	// 		isEmail 	= true,
	// 		labelName 	= '';
	// 		inputEmail	= '';

	// 	jQuery(this).parents('form').find('input[required="required"]').each(function(){
	// 		if( $.trim( jQuery(this).val().replace(/\s/g, "").length ) == 0 )
	// 		{
	// 			access = false;
	// 		}
	// 		else if( jQuery(this).parents('form').find('input[type="email"]').isEmail() === false )
	// 		{
	// 			isEmail = access = false;
	// 		}
	// 	});

	// 	lastModalId = '#' + jQuery(this).parents('.modal').attr('id');

	// 	if( access === false && isEmail === false )
	// 	{
	// 		$.alerta('Ingrese un correo valido.');
	// 	}
	// 	else if( access === false )
	// 	{
	// 		$.alerta('Rellene todos los campos, por favor.');
	// 	}
	// 	else if( access === true && isEmail === true )
	// 	{
	// 		return jQuery(this).parents('form').submit();
	// 	}

	// 	return false;
	// });
	
	// START TOOLS
	// jQuery('body').on('click', '.confirm', function(e) {
	// 	e.preventDefault();

	// 	message = jQuery(this).data('message');
	// 	url 	= jQuery(this).data('url');

	// 	$.confirmar(message, url);
	// });
	// END TOOLS
});

//]]>