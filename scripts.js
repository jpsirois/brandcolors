$(document).ready(function() {

	$('.color').each(function() {

		$(this).append('<h2 class="one first"></h2><div class="copy one"><span>Copy to clipboard.</span></div><div class="hex one"><span></span></div>');

		var brand = $(this).attr('data-brand');
		var hex = $(this).attr('data-hex');

		$(this).css('background-color', hex);
		$(this).children('h2').text(brand);
		$(this).children('.hex').children('span').text(hex);

		$(this).children('.copy').children('span').zclip({
			path: 'ZeroClipboard.swf',
			copy: $(this).attr('data-hex'),
			afterCopy:function() {
				alert('Copied!');
			}
		});

	});

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