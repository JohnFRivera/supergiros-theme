jQuery(document).ready(function($) {
	const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
	let query = new Query();
	let fecha = '';
	let results = [];
	
	/**
	 * Manejar conteos de la página
	 */
	function getCounter() {
		let themeData = JSON.parse(window.localStorage.getItem('supergiros-theme'));
		if (!themeData || !themeData.sorteos_y_loterias || !themeData.sorteos_y_loterias.found_posts) {
			return 1;
		}
		return themeData.sorteos_y_loterias.found_posts;
	}
	function setCounter(counter) {
		let themeData = JSON.parse(window.localStorage.getItem('supergiros-theme'));
		if (!themeData) {
			themeData = { sorteos_y_loterias: { found_posts: 1 } };
		} else if (!themeData.sorteos_y_loterias) {
			themeData.sorteos_y_loterias = { found_posts: 1 };
		}
		themeData.sorteos_y_loterias.found_posts = counter;
		window.localStorage.setItem('supergiros-theme', JSON.stringify(themeData));
	}
	
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
	};
	
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
	};
	
	/**
	 * Formatear fecha para componente del resultado
	 * 
	 * @returns {string} Fecha formateada
	 */
	function dateResult() {
		let arr = fecha.split('/');
		let day = parseInt(arr[0]);
		let month = meses[parseInt(arr[1]) - 1];
		let year = parseInt(arr[2]);
		return `${day} ${month} ${year}`;
	}
	
	/**
	 * Formatear hora obtenida de la consulta
	 * 
	 * @param {string} hour Hora del resultado
	 * @returns {string} Hora formateada
	 */
	function hourFormat(time) {
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
			<div class="d-flex align-items-center justify-content-center bg-secondary rounded-circle shadow-sm" style="width: 34px;height: 34px;">
				<div class="d-flex align-items-center justify-content-center bg-white rounded-circle fw-semibold" style="width: 22px;height: 22px;">${digit}</div>
			</div>`;
		});
		return balls;
	};
	
	function ResultPlaceholder() {
		return `
		<tr>
			<td class="align-middle ps-3" style="width: 510px;">
				<p class="placeholder-glow mb-0">
					<span class="placeholder rounded me-4" style="width: 50px;"></span>
					<span class="placeholder rounded col-${Math.floor(Math.random() * 3) + 1}"></span>
					<span class="placeholder rounded col-${Math.floor(Math.random() * 2) + 1}"></span>
				</p>
			</td>
			<td class="align-middle" style="width: 159.75px;">
				<p class="placeholder-glow ms-5 mb-0"><span class="placeholder rounded col-8"></span></p>
			</td>
			<td class="py-3 pe-3" style="width: 423.75px;">
				<div class="hstack justify-content-end gap-1">
					<div class="bg-dark bg-opacity-50 rounded-circle" style="width: 32px;height: 32px;"></div>
					<div class="bg-dark bg-opacity-50 rounded-circle" style="width: 32px;height: 32px;"></div>
					<div class="bg-dark bg-opacity-50 rounded-circle" style="width: 32px;height: 32px;"></div>
					<div class="bg-dark bg-opacity-50 rounded-circle" style="width: 32px;height: 32px;"></div>
					<div class="ms-2" style="width: 64px;">
						${!Math.floor(Math.random() * 5)? `<div class="bg-dark bg-opacity-50 rounded-pill" style="width: 58.34px;height: 32px;"></div>` : ''}
					</div>
				</div>
			</td>
		</tr>`;
	};
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
	};
	
	function renderTable() {
		$('#lotteryResults').html(`
		<table class="table table-hover mb-0">
			<tbody id="lotteryResultsTbody"></tbody>
		</table>`);
	}
	
	async function renderResults() {
		// Placeholder
		let foundPosts = getCounter();
		renderTable();
		for(let i = 0; i < foundPosts; i++) {
			$('#lotteryResultsTbody').append(ResultPlaceholder());
		}
		// Consulta
		let data = await query.get(`sorteos-y-loterias/resultados/?fecha=${fecha}`);
		renderTable();
		if (data.results.length) {
			setCounter(data.results.length);
			results = data.results;
			data.results.forEach((result, i) => {
				$('#lotteryResultsTbody').append(ResultRow(result));
			});
		} else {
			$('#lotteryResults').html(`
			<div class="h-100 d-flex align-items-center justify-content-center">
				<p>No hay ningún resultado aún</p>
			</div>`);
		}
	};
	
	function initEvents() {
		$('#resultsDate').change(async function() {
			fecha = dateFormat($(this).val());
			renderResults();
		});
		$('#slOrder').change(function() {
			if (results.length) {
				let arr = $(this).val().split('|');
				let orderby = arr[0] === 'modified' ? 'HORA' : 'NOMBRE';
				let order = arr[1];
				let container = $('#lotteryResults');
				results.sort((a, b) => {
					if (a[orderby] < b[orderby]) return order === 'ASC' ? -1 : 1;
					if (a[orderby] > b[orderby]) return order === 'ASC' ? 1 : -1;
					return 0;
				});
				renderTable();
				results.forEach((result, i) => {
					$('#lotteryResultsTbody').append(ResultRow(result));
				});
			}
		});
		$('#ipSearch').on('input', function() {
			let container = $('#lotteryResults');
			let search = $(this).val().toLowerCase();
			renderTable();
			(search ? results.filter(r => r.NOMBRE.toLowerCase().includes(search)) : results).forEach((result, i) => {
				$('#lotteryResultsTbody').append(ResultRow(result));
			});
		});
	}

	function onCreate() {
		fecha = dateNow();
		document.getElementById('resultsDate').max = new Date().toISOString().split('T')[0];
		renderResults();
		initEvents();
	}
	onCreate();
});
