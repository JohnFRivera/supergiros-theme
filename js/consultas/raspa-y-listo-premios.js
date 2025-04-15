// DATOS
let id;
let rows;
let rowsBackup;
// ELEMENTOS
let container = document.getElementById('container');
let frmRaspa;
let ipCedula;
let btnSearch;
let btnBack;
let rowPremios;
const spinner = `
<div class="d-flex justify-content-center">
	<div class="spinner-border text-primary" role="status">
	  <span class="visually-hidden">Loading...</span>
	</div>
	<span role="status" class="fs-5 ms-3">Espera un momento...</span>
</div>
`;
// PROCESOS
/**
 * Crear buscador de cedulas
 */
const innerIdSearcher = () => {
	container.innerHTML = `
	<div class="row mb-4">
		<div class="col col-sm-10 col-md-8 col-lg-6 col-xl-4 mx-auto">
			<form id="frm-raspa" class="bg-body rounded border shadow p-4">
				<label class="text-black mb-2" for="ip-cedula">Digite la cedula:</label>
				<div class="hstack bg-body rounded border shadow overflow-hidden">
					<input type="search" class="form-control rounded-0 border-0 shadow-none" id="ip-cedula" required pattern="^[0-9]*$" title="Solo se admiten caracteres numéricos" autocomplete="off" />
					<button type="submit" class="btn btn-secondary rounded-0" id="btn-search">
						<i class="bi bi-search"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
	`;
	id = '';
	rows = [];
	frmRaspa = document.getElementById('frm-raspa');
	ipCedula = document.getElementById('ip-cedula');
	btnSearch = document.getElementById('btn-search');
	btnBack = undefined;
	rowPremios = undefined;
	// Eventos
	frmRaspa.addEventListener('submit', async (e) => {
		try {
			e.preventDefault();
			if (e.target.reportValidity()) {
				cedula = ipCedula.value;
				await getPremios();
			}
		} catch (error) {
			innerError(error, container);
		}
	});
}
/**
 * Crear datatable
 */
const innerDatatable = () => {
	container.innerHTML = `
	<div class="row mb-4">
		<div class="col-auto ms-auto">
			<button type="button" id="btn-back" class="btn btn-secondary">
				<i class="bi bi-search"></i>
				Volver
			</button>
		</div>
	</div>
	<div class="row row-cols-2 g-4 mb-3" id="row-premios"></div>
	`;
	frmRaspa = undefined;
	ipCedula = undefined;
	btnSearch = undefined;
	btnBack = document.getElementById('btn-back');
	rowPremios = document.getElementById('row-premios');
	// Eventos
	btnBack.addEventListener('click', () => {
		innerIdSearcher();
	});
}
/**
 * Llenar tabla con el inventario
 */
const fillRows = () => {
    rowPremios.innerHTML = '';
    rows.forEach((row) => {
        rowPremios.innerHTML += `
		<div class="col">
			<div class="position-relative bg-body shadow rounded p-4">
				<span class="position-absolute top-0 start-0 badge bg-primary rounded-1 mt-4 ms-4">${row.ID}</span>
				<div class="row">
					<div class="col d-flex align-items-center gap-2">
						<i class="bi bi-person-circle fs-1"></i>
						<div>
							<p class="text-black-50 mb-0">Cajero</p>
							<p class="h5 mb-0">${row.CAJERO}</p>
						</div>
					</div>
					<div class="col d-flex flex-column">
						<p class="text-black-50 mb-1">Fecha de Pago</p>
						<p class="fw-medium">
							<i class="bi bi-calendar"></i>
							${row.FECHAPAGO}
						</p>
						<p class="text-black-50 mb-1">Hora de Pago</p>
						<p class="fw-medium mb-0">
							<i class="bi bi-clock"></i>
							${row.HORAPAGO}
						</p>
					</div>
					<div class="col d-flex flex-column">
						<p class="text-black-50 mb-1">Total del Premio</p>
						<p class="fw-medium">
							${moneyFormat(row.TOTALPREMIO)}
						</p>
						<p class="text-black-50 mb-1">Acumulado</p>
						<p class="fw-medium mb-0">
							${moneyFormat(row.ACUMULADO)}
						</p>
					</div>
				</div>
				<hr />
				<div class="row">
					<div class="col">
						<p class="text-black-50 mb-1">Código de Venta</p>
						<p class="fw-medium mb-0">
							<i class="bi bi-upc-scan"></i>
							${row.CODIGOVENTA}
						</p>
					</div>
					<div class="col">
						<p class="text-black-50 mb-1">Recambio</p>
						<p class="fw-medium mb-0">
							<i class="bi bi-upc-scan"></i>
							${row.RECAMBIO}
						</p>
					</div>
				</div>
			</div>
		</div>
        `;
    });
};
/**
 * Obtener inventario
 */
const getPremios = async () => {
    try {
        container.innerHTML = spinner;
        // Fetch
        var data = await fetchGET(`raspa-y-listo/premios-pagados/?cedula=${cedula}`);
        if (data.premios_pagados.length > 0) {
            rows = data.premios_pagados;
			innerDatatable();
			fillRows();
        } else {
            container.innerHTML = `
			<div class="row">
				<div class="col">
					<div class="w-100">
						<p class="text-black-50 text-center">
							No hay ningún premio pagado aún o escribiste mal la cedula
							<i class="bi bi-emoji-frown"></i>
						</p>
						<button type="button" id="btn-back" class="d-block btn btn-secondary rounded-1 mx-auto">
							<i class="bi bi-search"></i>
							Volver
						</button>
					</div>
				</div>
			</div>
			`;
			btnBack = document.getElementById('btn-back');
			// Eventos
			btnBack.addEventListener('click', () => {
				innerIdSearcher();
			});
        }
    } catch (error) {
        throw error;
    }
};
/**
 * Formato de moneda
 */
const moneyFormat = (number) => {
	const formatter = new Intl.NumberFormat('es-CO', {
	  	style: 'currency',
	  	currency: 'COP', // Cambia 'EUR' por la moneda que desees, por ejemplo, 'USD' para dólares
		minimumFractionDigits: 0, // No mostrar decimales
  		maximumFractionDigits: 0  // No mostrar decimales
	}).format(number);
	return formatter;
}
// EVENTOS
document.addEventListener('DOMContentLoaded', () => {
	innerIdSearcher();
});
