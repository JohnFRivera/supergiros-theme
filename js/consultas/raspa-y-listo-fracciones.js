// DATOS
let fraccion;
let rows;
let rowsBackup;
// ELEMENTOS
let container = document.getElementById('container');
let frmFraccion;
let ipFraccion;
let btnSearch;
let btnBack;
let rowFracciones;
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
 * Crear buscador de fracciones
 */
const innerIdSearcher = () => {
	container.innerHTML = `
	<div class="row mb-4">
		<div class="col col-sm-10 col-md-8 col-lg-6 col-xl-4 mx-auto">
			<form id="frm-fraccion" class="bg-body rounded border shadow p-4">
				<label class="text-black mb-2" for="ip-fraccion">Escanee o digite la fracción:</label>
				<div class="hstack bg-body rounded border shadow overflow-hidden">
					<input type="search" class="form-control rounded-0 border-0 shadow-none" id="ip-fraccion" required pattern="^[0-9]*$" title="Solo se admiten caracteres numéricos" autocomplete="off" />
					<button type="submit" class="btn btn-secondary rounded-0" id="btn-search">
						<i class="bi bi-search"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
	`;
	fraccion = '';
	rows = [];
	frmFraccion = document.getElementById('frm-fraccion');
	ipFraccion = document.getElementById('ip-fraccion');
	btnSearch = document.getElementById('btn-search');
	btnBack = undefined;
	rowFracciones = undefined;
	// Eventos
	frmFraccion.addEventListener('submit', async (e) => {
		try {
			e.preventDefault();
			if (e.target.reportValidity()) {
				fraccion = ipFraccion.value;
				await getFracciones();
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
			<div class="shadow rounded">
				<button type="button" id="btn-back" class="btn btn-secondary rounded-1">
					<i class="bi bi-search"></i>
					Volver
				</button>
			</div>
		</div>
	</div>
	<div class="bg-body shadow rounded mb-3 p-4" id="row-fracciones"></div>
	`;
	frmFraccion = undefined;
	ipFraccion = undefined;
	btnSearch = undefined;
	btnBack = document.getElementById('btn-back');
	rowFracciones = document.getElementById('row-fracciones');
	// Eventos
	btnBack.addEventListener('click', () => {
		innerIdSearcher();
	});
}
/**
 * Llenar tabla con el inventario
 */
const fillRows = () => {
    rowFracciones.innerHTML = '';
    rows.forEach((row) => {
		var pagado = pagadoFormat(row.PAGADO);
        rowFracciones.innerHTML += `
		<div class="row">
			<div class="col d-flex align-items-center gap-3">
				<h5 class="text-primary fw-bold mb-0">PAQUETE:</h5>
				<p class="h6 mb-0">${row.KDXUNIBOD_CODIGO}</p>
			</div>
		</div>
		<hr />
		<div class="row">
			<div class="col">
				<h5 class="text-primary fw-bold mb-3">PRODUCTO</h5>
				<p class="text-black-50 mb-0">NOMBRE</p>
				<p class="h6 mb-3">
					<i class="bi bi-ticket"></i>
					${row.PRODUCTO}
				</p>
				<p class="text-black-50 mb-0">BODEGA</p>
				<p class="h6 mb-3">
					<i class="bi bi-shop-window"></i>
					${row.BODEGA}
				</p>
				<p class="text-black-50 mb-0">ESTADO</p>
				<span class="badge text-bg-${row.ESTADOFRACCION === 'VENDIDA' ? 'success' : 'warning'}">
					<i class="bi bi-check-lg"></i>
					${row.ESTADOFRACCION}
				</span>
			</div>
			<div class="col">
				<h5 class="text-primary fw-bold mb-3">DETALLES</h5>
				<p class="text-black-50 mb-0">NUMERO</p>
				<p class="h6 mb-3">${row.NUMERO}</p>
				<p class="text-black-50 mb-0">SERIE</p>
				<p class="h6 mb-3">${row.SERIE}</p>
				<p class="text-black-50 mb-0">FRACCION</p>
				<p class="h6 mb-0">${row.FRACCION}</p>
			</div>
			<div class="col">
				<h5 class="text-primary fw-bold mb-3">VENTA</h5>
				<p class="text-black-50 mb-0">VENDEDOR</p>
				<p class="h6 mb-3">
					<i class="bi bi-person-vcard"></i>
					${row.VENDEDOR}
				</p>
				<p class="text-black-50 mb-0">FECHA</p>
				<p class="h6 mb-3">
					<i class="bi bi-calendar"></i>
					${row.FECHA}
				</p>
				<p class="text-black-50 mb-0">HORA</p>
				<p class="h6 mb-0">
					<i class="bi bi-clock"></i>
					${row.HORA}
				</p>
			</div>
			<div class="col">
				<h5 class="text-primary fw-bold mb-3">PAGO</h5>
				<p class="text-black-50 mb-0">RECIBIÓ</p>
				<p class="h6 mb-3">
					<i class="bi bi-person-vcard"></i>
					${pagado.CEDULA}
				</p>
				<p class="text-black-50 mb-0">FECHA</p>
				<p class="h6 mb-3">
					<i class="bi bi-calendar"></i>
					${pagado.FECHA}
				</p>
				<p class="text-black-50 mb-0">HORA</p>
				<p class="h6 mb-0">
					<i class="bi bi-clock"></i>
					${pagado.HORA}
				</p>
			</div>
		</div>
        `;
    });
};
/**
 * Obtener inventario
 */
const getFracciones = async () => {
    try {
        container.innerHTML = spinner;
        // Fetch
        var data = await fetchGET(`raspa-y-listo/validar-fracciones/?fraccion=${fraccion}`);
        if (data.validacion.length > 0) {
            rows = data.validacion;
			innerDatatable();
			fillRows();
        } else {
            container.innerHTML = `
			<div class="row">
				<div class="col">
					<div class="w-100">
						<p class="text-black-50 text-center">
							No hay ningúna fracción aún o escribiste mal la fracción
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
 * Formato a pagado
 */
const pagadoFormat = (pagado) => {
	var response = {};
	var arrPagado = pagado.split('-');
	var arrDate = arrPagado[1].trim().split(' ');
	response.CEDULA = arrPagado[0].trim();
	response.FECHA = arrDate[0];
	response.HORA = arrDate[1];
	return response;
}
// EVENTOS
document.addEventListener('DOMContentLoaded', () => {
	innerIdSearcher();
});
