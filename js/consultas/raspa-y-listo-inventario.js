// DATOS
let id;
let rows;
let rowsBackup;
// ELEMENTOS
let container = document.getElementById('container');
let frmRaspa;
let ipCedula;
let btnSearch;
let frmSearch;
let ipSearch;
let slOrder;
let btnBack;
let containerTbl;
let bodyInventory;
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
	containerTbl = undefined;
	bodyInventory = undefined;
	// Eventos
	frmRaspa.addEventListener('submit', async (e) => {
		try {
			e.preventDefault();
			if (e.target.reportValidity()) {
				cedula = ipCedula.value;
				await getInventory();
				fillTable();
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
		<div class="col-4">
			<label class="text-nowrap mb-2" for="ip-search">Producto:</label>
			<form class="w-100 d-flex align-items-center shadow bg-body rounded" id="frm-search">
				<input class="form-control-plaintext px-3" type="search" id="ip-search" placeholder="Buscar..." autocomplete="off" required>
				<button type="submit" class="btn btn-secondary rounded-start-0 rounded-end-1">
					<i class="bi bi-search"></i>
				</button>
			</form>
		</div>
		<div class="col-auto ms-auto">
			<label class="text-nowrap mb-2" for="sl-order">Valor:</label>
			<div class="shadow-sm bg-body rounded-1">
				<select class="w-100 form-select shadow-none bg-body border-0 rounded ps-3" id="sl-order">
					<option value="">Por defecto</option>
					<option value="DESC">Más altos</option>
					<option value="ASC">Más bajos</option>
				</select>
			</div>
		</div>
		<div class="col-auto align-content-end">
			<div class="shadow-sm rounded-1">
				<button type="button" id="btn-back" class="btn btn-secondary rounded">
					<i class="bi bi-search"></i>
					Volver
				</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col d-none" id="container-tbl">
			<figure class="wp-block-table bg-primary" style="border-radius: 0.25rem 0.25rem 0 0 !important;margin-bottom: 0 !important;padding-right: 17px !important;">
				<table>
					<thead>
						<tr>
							<th class="ps-3" style="width: 331.5px;">
								<i class="bi bi-ticket"></i>
								PRODUCTO
							</th>
							<th style="width: 275.25px;">
								<i class="bi bi-shop-window"></i>
								BODEGA
							</th>
							<th class="has-text-align-center" data-align="center" style="width: 111.66px;">SORTEO</th>
							<th class="has-text-align-center" data-align="center" style="width: 127.02px;">
								<i class="bi bi-currency-dollar"></i>
								VALOR
							</th>
							<th class="has-text-align-center" data-align="center" style="width: 162.77px;">FRACCIONES</th>
							<th class="has-text-align-center" data-align="center" style="width: 126.48px;">VENDIDA</th>
							<th class="has-text-align-center text-nowrap" data-align="center" style="width: 142.33px;">SIN VENTA</th>
						</tr>
					</thead>
				</table>
			</figure>
			<figure class="wp-block-table bg-body overflow-y-scroll mb-0" style="height: 650px;border-radius: 0 0 0.25rem 0.25rem !important;">
				<table>
					<tbody id="body-inventory"></tbody>
				</table>
			</figure>
		</div>
	</div>
	`;
	frmRaspa = undefined;
	ipCedula = undefined;
	btnSearch = undefined;
	frmSearch = document.getElementById('frm-search');
	ipSearch = document.getElementById('ip-search');
	slOrder = document.getElementById('sl-order');
	btnBack = document.getElementById('btn-back');
	containerTbl = document.getElementById('container-tbl');
	bodyInventory = document.getElementById('body-inventory');
	// Eventos
	frmSearch.addEventListener('submit', (e) => {
		e.preventDefault()
		if (e.target.reportValidity()) {
			rows = rowsBackup.filter(item => item.PRODUCTO.toLowerCase().includes(ipSearch.value.toLowerCase()));
			if (rows.length > 0) {
				fillTable();
			} else {
				bodyInventory.innerHTML = `
				<tr>
					<td></td>
					<td class="py-3 align-content-center">
						<p class="text-black-50 text-center mb-0">
							${message}
							<i class="bi bi-emoji-frown"></i>
						</p>
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				`;
			}	
		}
	});
	ipSearch.addEventListener('input', (e) => {
		if (!e.target.value) {
			rows = rowsBackup;
			fillTable();
		}
	});
	slOrder.addEventListener('change', (e) => {
		if (e.target.value) {
			rows = rowsBackup.sort((a, b) => {
				const valorA = a.VALOR;
				const valorB = b.VALOR;

				if (e.target.value === 'ASC') {
				  return valorA - valorB;  // Orden ascendente
				} else {
				  return valorB - valorA;  // Orden descendente
				}
			});
		} else {
			rows = rowsBackup.sort((a, b) => {
				if (a.BODEGA > b.BODEGA) {
					return -1;
				}
				if (a.BODEGA < b.BODEGA) {
					return 1;
				}
				return 0;
			});
		}
		fillTable();
	});
	btnBack.addEventListener('click', () => {
		innerIdSearcher();
		window.scrollTo({
			top: 0,
			behavior: 'smooth',
		});
	});
}
/**
 * Llenar tabla con el inventario
 */
const fillTable = () => {
    bodyInventory.innerHTML = '';
    rows.forEach((row, i) => {
        bodyInventory.innerHTML += `
        <tr id="raspa-${i}">
			<td class="fw-medium py-3 ps-3" style="width: 331.5px;">
				${row.PRODUCTO}
			</td>
			<td class="text-black-50 py-3" style="width: 275.25px;">
				${row.BODEGA}
			</td>
			<td class="text-center py-3" style="width: 111.66px;">
				${row.SORTEO}
			</td>
			<td class="text-center fw-medium py-3" style="width: 127.02px;">
				${moneyFormat(row.VALOR)}
			</td>
			<td class="text-center py-3" style="width: 162.77px;">
				${row.FRACCIONES}
			</td>
			<td class="text-center py-3" style="width: 126.48px;">
				${row.VENDIDA > 0 ? `<span class="badge text-bg-success rounded-1 fs-6">${row.VENDIDA}</span>` : ''}
			</td>
			<td class="text-center py-3" style="width: 142.33px;">
				${row.SINVENTA > 0 ? `<span class="badge text-bg-warning rounded-1 fs-6">${row.SINVENTA}</span>` : ''}
			</td>
		</tr>
        `;
    });
	containerTbl.classList.remove('d-none');
	window.scrollTo({
		top: 183,
		behavior: 'smooth',
	});
};
/**
 * Obtener inventario
 */
const getInventory = async () => {
    try {
        container.innerHTML = spinner;
        // Fetch
        var data = await fetchGET(`raspa-y-listo/inventario/?cedula=${cedula}`);
        if (data.inventario.length > 0) {
            rows = data.inventario;
			rowsBackup = data.inventario;
        } else {
            container.innerHTML = `
			<div class="row">
				<div class="col">
					<div class="w-100">
						<p class="text-black-50 text-center">
							No hay ningún inventario aún o escribiste mal la cedula
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
    } finally {
		innerDatatable();
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
