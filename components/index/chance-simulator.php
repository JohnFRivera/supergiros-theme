<?php
wp_enqueue_script(
	'chance-simulator',
	get_template_directory_uri() . '/js/components/chance-simulator.js',
	array(),
	null,
	true
);
?>
<div class="d-flex align-items-center py-5" style="min-height: 87.3vh;">
	<div class="w-100 mb-5">
		<div class="position-relative shadow rounded overflow-hidden">
			<div class="bg-danger" style="height: 170px;">
				<div class="h-100 align-content-end">
					<div class="bg-white rounded-top-circle" style="height: 80px;"></div>
				</div>
			</div>
			<img id="csLogo" class="position-absolute top-0 start-50 translate-middle-x mt-4" src="<?php echo supergiros_image_url('logos/logo-chance.webp'); ?>" alt="Logo Chance" width="180px">
			<div class="bg-white">
				<form id="csFrmSimulator" class="w-75 mx-auto">
					<div class="mb-3">
						<label class="fw-medium mb-2" style="color: #093B81;" for="csIpMonto">Monto</label>
						<div class="shadow-sm rounded-4">
							<input type="text" name="monto" id="csIpMonto" class="form-control shadow-none bg-white rounded" placeholder="$ 0" autocomplete="off" required/>
						</div>
					</div>
					<div class="row mb-4">
						<div class="col">
							<label for="csSlModality" class="fw-medium mb-2" style="color: #093B81;">Modalidad</label>
							<div class="shadow-sm rounded">
								<select id="csSlModality" name="type" class="form-select shadow-none bg-white rounded" required>
									<option value="tradicional">Tradicional</option>
									<option value="tripletazo">Tripletazo</option>
									<option value="astro-millonario">Astro Millonario</option>
									<option value="kash1">Kash1</option>
									<option value="kash2">Kash2</option>
									<option value="kash3">Kash3</option>
									<option value="kash4">Kash4</option>
									<option value="kash5">Kash5</option>
									<option value="kash6">Kash6</option>
									<option value="kash7">Kash7</option>
									<option value="kash8">Kash8</option>
									<option value="kash9">Kash9</option>
									<option value="kash10">Kash10</option>
								</select>
							</div>
						</div>
						<div class="col">
							<label for="csSlHit" class="fw-medium mb-2" style="color: #093B81;">Aciertos</label>
							<div class="shadow-sm rounded">
								<select id="csSlHit" name="modality" class="form-select shadow-none bg-white rounded" required></select>
							</div>
						</div>
					</div>
					<button type="submit" id="csBtnCalculate" class="btn btn-primary w-100 mb-4">Calcular</button>
				</form>
				<div id="csToggle" style="display: none;"></div>
				<small class="d-block opacity-75 text-center lh-1 px-4 pb-4 mb-0">Al reclamar un premio recuerda revisar los <a href="#">Requisitos para Pago de Premios</a></small>
			</div>
		</div>
	</div>
</div>
