jQuery(document).ready(function($) {
	$('#navSection').on('click', 'button', function() {
		window.scrollTo({
			top: $(this).data('top'),
			behavior: 'smooth',
		});
	});
});
