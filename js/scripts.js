$(document).ready(function() {

	$('#search').keyup(function() {
		var searchterm = $('#search').val().toLowerCase();

		$('.color').each(function() {
			var brand = $(this).attr('data-brand').toLowerCase();
			if (brand.indexOf(searchterm) == 0) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
	});

});