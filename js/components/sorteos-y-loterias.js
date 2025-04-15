jQuery(document).ready(function($) {
	let query = new Query();
	let fecha = '';
	
	/**
	 * Obtener la fecha actual con el formato indicado
	 * 
	 * @returns {string} Fecha formateada
	 */
	function dateNow() {
		let date = new Date();
		let day = date.getDate();
		let month = date.getMonth() + 1;
		let year = date.getFullYear();
		return `${day < 10 ? '0' + day : day}/${month < 10 ? '0' + month : month}/${year}`;
	}
	
	/**
	 * Formatear fecha para hacer consulta
	 * 
	 * @param {Date} date Fecha a consultar
	 * @returns {string} Fecha formateada
	 */
	function dateFormat(date) {
		let arr = date.split('-');
		let day = arr[2];
		let month = arr[1];
		let year = arr[0];
		return `${day}/${month}/${year}`;
	}
	
	/**
	 * Formatear hora obtenida de la consulta
	 * 
	 * @param {string} hour Hora del resultado
	 * @returns {string} Hora formateada
	 */
	const hourFormat = (time) => {
		let arr = time.split(':');
		let hour = arr[0];
		let minutes = arr[1];
		let horary = hour < 12 ? 'a.m.' : 'p.m.';
		hour > 12 && (hour -= 12);
		return `${hour}:${minutes} ${horary}`;
	};
	
	/**
	 * Dar formato de bolas al resultado de la lotería
	 * 
	 * @param {string} result Resultado de la lotería
	 * @returns {string} Resultado con formato de bolas
	 */
	function ballContentFormat(result) {
		let arr = result.split('');
		let balls = '';
		arr.forEach(digit => {
			balls += `
			<div class="d-flex align-items-center justify-content-center bg-secondary rounded-circle shadow-sm" style="width: 32px;height: 32px;">
				<div class="d-flex align-items-center justify-content-center bg-white rounded-circle fw-medium" style="width: 20px;height: 20px;">${digit}</div>
			</div>`;
		});
		return balls;
	}
	
	function ResultPlaceholder() {
		return `
		<div class="h-100 d-flex align-items-center justify-content-center">
			<div class="spinner-border text-primary" role="status">
				<span class="visually-hidden">Cargando...</span>
			</div>
		</div>`;
	}
	function ResultRow(result) {
		return `
		<tr id="">
			<td class="align-content-center ps-3">
				<div class="hstack">
					<div class="text-black-50" style="width: 70px;">${result.ABREVIATURA}</div>
					<div class="fw-semibold">${result.NOMBRE}</div>
				</div>
			</td>
			<td class="align-content-center text-black-50">${hourFormat(result.HORA)}</td>
			<td class="py-3 pe-3">
				<div class="hstack justify-content-end gap-1">
					${ballContentFormat(result.RESULTADO)}
					<div class="ms-2" style="width: 64px;">
						${result.SERIE ? `
						<div class="d-flex align-items-center justify-content-center bg-primary rounded-pill shadow-sm px-2" style="height: 32px;">
							<div class="w-100 d-flex align-items-center justify-content-center bg-white rounded-pill fw-medium px-2" style="height: 20px;">${result.SERIE}</div>
						</div>` : ''}
					</div>
				</div>
			</td>
		</tr>`;
	}
	
	async function renderResults() {
		let container = $('#lotteryResults');
		container.html(ResultPlaceholder());
		// Consulta
		let data = await query.get(`sorteos-y-loterias/resultados/?fecha=${fecha}`);
		container.html(`
		<table class="table table-hover mb-0">
			<tbody id="lotteryResultsTbody"></tbody>
		</table>`);
		if (data.results.length) {
			data.results.forEach((result, i) => {
				$('#lotteryResultsTbody').append(ResultRow(result));
			});
		} else {
			container.html(`
			<div class="h-100 d-flex align-items-center justify-content-center">
				<p>No hay ningún resultado aún</p>
			</div>`);
		}
	}

	function initEvents() {
		$('#lotteryResultsDate').change(async function() {
			fecha = dateFormat($(this).val());
			renderResults();
		});
	}

	function onCreate() {
		fecha = dateNow();
		document.getElementById('lotteryResultsDate').max = new Date().toISOString().split('T')[0];
		renderResults();
		initEvents();
	}
	onCreate();
});
