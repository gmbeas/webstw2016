/*
 *
 * Andain, Desarrollo y Diseño Web
 * http://www.andain.cl/ <contacto@andain.cl>
 */

//<![CDATA[
//------------------------ JQUERY
jQuery(document).ready(function() {

	var pr = function(data) {
		console.debug(data);
	}

	jQuery('body').on('click', '.delete-row', function(e){
		e.preventDefault();
		var url = jQuery(this).data('url');

		$.confirmar('Está seguro que desea eliminar éste registro?', url);
	});
	
	// START ACLS
	jQuery('.all-permissions .rootSelect').click(function(e){
		var currentPanel = jQuery(this).parents('.tab-pane.active');

		currentPanel.find('table input:checkbox').attr('checked', this.checked);

		if( this.checked ) {
			currentPanel.find('table div.checker span').addClass('checked');
		} else {
			currentPanel.find('table div.checker span').removeClass('checked');
		}
	});

	jQuery('.all-permissions .fatherSelect').click(function(){
		jQuery('.selectAll span input:checkbox').removeAttr('checked');
		jQuery('.selectAll span').removeClass('checked');

		var currentTable = jQuery(this).parents('table.permisos');

		currentTable.find('tbody tr td input:checkbox').attr('checked', this.checked);

		if( this.checked ) {
			currentTable.find('tbody tr td div.checker span').addClass('checked');
		} else {
			currentTable.find('tbody tr td div.checker span').removeClass('checked');
		}
	});

	jQuery('table.permisos').each(function(){
		var currentBodyRow 	= jQuery('tbody tr', this),
			totalRows 		= currentBodyRow.length,
			totalChecked 	= jQuery('input:checkbox:checked', currentBodyRow).length;
		
		if( totalRows === totalChecked ) {
			jQuery('.fatherSelect', this).attr('checked', 'checked');
			jQuery('.checker span', this).addClass('checked');
		}
	});
	// END ACLS
});

//]]>