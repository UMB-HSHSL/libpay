$(document).ready(function() {

	$('#hshsl_category').change(function(event) {
		if ('Other' == $(this).val()) {
			$('#category_other').show();
		} else {
			$('#category_other').hide();
		}
	});
	
}); //doc ready
