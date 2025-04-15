jQuery(document).ready(function($) {
	const months = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
	const date = new Date();
	const texts = $('#txtMessage').find('strong');
	const txtMonth = texts[0].innerText;
	const txtYear = texts[1].innerText;
	if (txtMonth.toLowerCase() === months[date.getMonth()] && parseInt(txtYear) === date.getFullYear()) {
		let countColocadores = 0;
		let countPersonal = 0;
		$('#tblColocadores tbody tr').each(function() {
			var lastTd = parseInt($(this).find('td:last').text());
			if (lastTd === date.getDate()) {
				$(this).addClass('table-active');
				$(this).find('td:first').append(`<i class="bi bi-cake ms-2"></i>`);
				countColocadores++;
			}
		});
		$('#tblPersonal tbody tr').each(function() {
			var lastTd = parseInt($(this).find('td:last').text());
			if (lastTd === date.getDate()) {
				$(this).addClass('table-active');
				$(this).find('td:first').append(`<i class="bi bi-cake ms-2"></i>`);
				countPersonal++;
			}
		});
		$('#txtColocadores').append(`<span class="badge bg-primary ms-2">${countColocadores}</span>`);
		$('#txtPersonal').append(`<span class="badge bg-primary ms-2">${countPersonal}</span>`);
	} else {
		$('#txtMessage').after(`
		<div class="d-flex justify-content-center mb-4">
			<div class="bg-warning bg-opacity-25 border border-warning rounded-1 overflow-hidden shadow-sm">
				<div class="hstack border-bottom border-4 border-warning py-2 ps-3 pe-5">
					<div><i class="bi bi-exclamation-triangle-fill text-warning-emphasis me-3"></i></div>
					<div>
						<h6 class="text-warning-emphasis mb-1">¡Advertencia!</h6>
						<p class="text-warning-emphasis mb-0">La fecha y los cumpleañeros están desactualizados, por favor actualizar los datos</p>
					</div>
				</div>
			</div>
		</div>`);
	}
});