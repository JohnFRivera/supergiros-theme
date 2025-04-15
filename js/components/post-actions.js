jQuery(document).ready(function($) {	
	let query = new Query();
	let previousUrl = document.referrer;

	$('#btnDeletePost').click(async function() {
		let btnCancel = $(this).prev();
		let btnDelete = $(this);
		let post_id = btnDelete.data('id');
		btnCancel.prop('disabled', true);
		btnDelete.prop('disabled', true);
		btnDelete.html(`<span class="spinner-border spinner-border-sm me-2" aria-hidden="true"></span><span role="status">Cargando...</span>`);
		let data = await query.delete('post', wpApiSettings.nonce, { post_id });
		if(data.deleted) {
			window.location.href = previousUrl;
		}
	});
});
