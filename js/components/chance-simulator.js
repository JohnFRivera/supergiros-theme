jQuery(document).ready(function($) {
	// Constantes
	const IVA 			= 0.19;
	const LIMITE 		= 2390000;
	const RETENCION 	= 0.2;
	// Componentes
	let ipMonto = $('#csIpMonto');
	let slHit = $('#csSlHit');
	let toggle = $('#csToggle');
	
	function numberFormat(number) { return number.toLocaleString('es-CO') }
	
	function HitOptions(value) {
		$('#csLogo').attr('src', window.location.origin + '/wp-content/themes/supergiros/assets/images/logos/logo-kash.png');
		switch(value) {
			case 'tradicional':
				$('#csLogo').attr('src', window.location.origin + '/wp-content/themes/supergiros/assets/images/logos/logo-chance.webp');
				return `
				<option value="5">1 Cifra</option>
				<option value="50">2 Cifras</option>
				<option value="400">3 Cifras</option>
				<option value="83">3 Cifras combinado</option>
				<option value="4500">4 Cifras</option>
				<option value="208">4 Cifras combinado</option>`;
				break;
			case 'tripletazo':
				$('#csLogo').attr('src', window.location.origin + '/wp-content/themes/supergiros/assets/images/logos/logo-tripletazo.png');
				return `
				<option value="7">1 Acierto en orden</option>
				<option value="250">2 Aciertos en orden</option>
				<option value="15336">3 Aciertos en orden</option>
				<option value="78300">3 Aciertos en desorden</option>`;
				break;
			case 'astro-millonario':
				$('#csLogo').attr('src', window.location.origin + '/wp-content/themes/supergiros/assets/images/logos/logo-astro.png');
				ipMonto.attr('min', 500);
				ipMonto.attr('max', 10000);
				return `
				<option value="100/12">2 Últimas con todos</option>
				<option value="100">2 Últimas + signo</option>
				<option value="1000/12">3 Últimas con todos</option>
				<option value="1000">3 Últimas + signo</option>
				<option value="42000/12">4 Cifras con todos</option>
				<option value="42000">4 Cifras + signo</option>`;
				break;
			case 'kash1':
				return `
				<option value="3">1 Acierto</option>`;
				break;
			case 'kash2':
				return `
				<option value="1">1 Acierto</option>
				<option value="10">2 Aciertos</option>`;
				break;
			case 'kash3':
				return `
				<option value="2">2 Aciertos</option>
				<option value="50">3 Aciertos</option>`;
				break;
			case 'kash4':
				return `
				<option value="1">2 Aciertos</option>
				<option value="10">3 Aciertos</option>
				<option value="100">4 Aciertos</option>`;
				break;
			case 'kash5':
				return `
				<option value="1">2 Aciertos</option>
				<option value="3">3 Aciertos</option>
				<option value="20">4 Aciertos</option>
				<option value="200">5 Aciertos</option>`;
				break;
			case 'kash6':
				return `
				<option value="2">3 Aciertos</option>
				<option value="10">4 Aciertos</option>
				<option value="60">5 Aciertos</option>
				<option value="800">6 Aciertos</option>`;
				break;
			case 'kash7':
				return `
				<option value="1">0 Aciertos</option>
				<option value="2">3 Aciertos</option>
				<option value="4">4 Aciertos</option>
				<option value="15">5 Aciertos</option>
				<option value="80">6 Aciertos</option>
				<option value="1500">7 Aciertos</option>`;
				break;
			case 'kash8':
				return `
				<option value="1">0 Aciertos</option>
				<option value="5">4 Aciertos</option>
				<option value="10">5 Aciertos</option>
				<option value="50">6 Aciertos</option>
				<option value="200">7 Aciertos</option>
				<option value="3000">8 Aciertos</option>`;
				break;
			case 'kash9':
				return `
				<option value="2">0 Aciertos</option>
				<option value="1">4 Aciertos</option>
				<option value="10">5 Aciertos</option>
				<option value="25">6 Aciertos</option>
				<option value="125">7 Aciertos</option>
				<option value="1500">8 Aciertos</option>
				<option value="6000">9 Aciertos</option>`;
				break;
			case 'kash10':
				return `
				<option value="2">0 Aciertos</option>
				<option value="5">5 Aciertos</option>
				<option value="20">6 Aciertos</option>
				<option value="100">7 Aciertos</option>
				<option value="300">8 Aciertos</option>
				<option value="2000">9 Aciertos</option>
				<option value="40000">10 Aciertos</option>`;
				break;
		}
	}
	
	function initEvents() {
		ipMonto.on('input', function() {
			let value = $(this).val().replace(/[^\d]/g, '');
			value.length ? $(this).val('$ ' + parseInt(value).toLocaleString('es-CO')) : $(this).val('');
			document.getElementById('csIpMonto').setCustomValidity('');
		});

		$('#csSlModality').change(function() {
			slHit.html(HitOptions($(this).val()));
		});
		
		$('#csFrmSimulator').submit(function(e) {
			e.preventDefault();
			let min = parseInt(ipMonto.attr('min'));
			let max = parseInt(ipMonto.attr('max'));
			let value = parseInt(ipMonto.val().replace(/[^\d]/g, ''));
			let montoElement = document.getElementById('csIpMonto');
			if (!value) {
				montoElement.setCustomValidity('Completa este campo');
			} else {
				if (min && value < min) {
					montoElement.setCustomValidity('La apuesta debe ser mínimo de ' + numberFormat(min));
				} else {
					if (max && value > max) {
						montoElement.setCustomValidity('La apuesta debe ser máximo de ' + numberFormat(max));
					} else {
						const MODALITY = parseFloat(eval(slHit.val()));
						const vlrBruto = value;
						const vlrIVA = vlrBruto * IVA;
						const vlrNeto = vlrBruto - vlrIVA;
						const prmBruto = vlrNeto * MODALITY;
						const prmRetencion = prmBruto >= LIMITE ? prmBruto * RETENCION : 0;
						const prmNeto = prmBruto - prmRetencion;

						toggle.html(`
						<div class="position-relative bg-danger mb-4 py-4 px-5">
							<button type="button" id="csBtnClose" class="position-absolute top-0 end-0 btn-close btn-close-white shadow-none mt-3 me-3" aria-label="Close"></button>
							<div class="mb-4">
								<h6 class="text-white text-center fw-bold lh-1 mb-0">PREMIO</h6>
								<h2 class="text-center fw-bolder lh-1">
									<span class="h4 fw-bold align-top me-1" style="color: #FFE501;">$</span><span style="color: #FFE501;">${numberFormat(prmNeto)}</span>
								</h2>
							</div>
							<div class="position-relative hstack gap-4 border rounded-1 text-white py-3 px-4">
								<h6 class="position-absolute top-0 start-50 translate-middle text-bg-danger fw-bold px-2">DETALLE</h6>
								<div class="w-50">
									<div class="vstack gap-2">
										<div class="hstack align-items-center justify-content-between">
											<small class="text-white text-opacity-75 mb-0">Valor Bruto</small>
											<small class="fw-medium mb-0">$ ${numberFormat(vlrBruto)}</small>
										</div>
										<div class="hstack align-items-center justify-content-between">
											<small class="text-white text-opacity-75 mb-0">Valor IVA ${IVA * 100}%</small>
											<small class="fw-medium mb-0">$ ${numberFormat(vlrIVA)}</small>
										</div>
										<div class="hstack align-items-center justify-content-between">
											<small class="text-white text-opacity-75 mb-0">Valor Neto</small>
											<small class="fw-medium mb-0">$ ${numberFormat(vlrNeto)}</small>
										</div>
									</div>
								</div>
								<div class="vr"></div>
								<div class="w-50">
									<div class="vstack gap-2">
										<div class="hstack align-items-center justify-content-between">
											<small class="text-white text-opacity-75 mb-0">Premio Bruto</small>
											<small class="fw-medium mb-0">$ ${numberFormat(prmBruto)}</small>
										</div>
										<div class="hstack align-items-center justify-content-between">
											<small class="text-white text-opacity-75 mb-0">Retención ${RETENCION * 100}%</small>
											<small class="fw-medium mb-0">$ ${numberFormat(prmRetencion)}</small>
										</div>
										<div class="hstack align-items-center justify-content-between">
											<small class="text-white text-opacity-75 mb-0">Premio Neto</small>
											<small class="fw-medium mb-0">$ ${numberFormat(prmNeto)}</small>
										</div>
									</div>
								</div>
							</div>
						</div>`);
						toggle.slideDown(200);
						toggle.find('#csBtnClose').click(function() {
							toggle.slideUp(200);
							ipMonto.val('');
						});
					}
				}
			}
			!montoElement.checkValidity() && montoElement.reportValidity();
		});
	}
	
	function onCreate() {
		slHit.html(HitOptions('tradicional'));
		initEvents();
	}
	onCreate();
});
