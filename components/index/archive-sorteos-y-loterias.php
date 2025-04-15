<?php
wp_enqueue_script(
	'lottery-results',
	get_template_directory_uri() . '/js/components/sorteos-y-loterias.js',
	array(),
	null,
	true
);
?>
<div class="d-flex align-items-center py-5" style="min-height: 87.3vh;">
	<div class="w-100 bg-body rounded shadow overflow-hidden">
		<div class="position-relative bg-secondary p-3">
			<h4 class="position-absolute start-50 translate-middle-x">Últimos Resultados de Hoy</h4>
			<div class="d-flex align-items-center justify-content-end gap-2">
				<label for="lotteryResultsDate">Consultar día:</label>
				<input type="date" id="lotteryResultsDate" class="form-control w-auto rounded border-0 shadow-none">
			</div>
		</div>
		<div id="lotteryResults" class="bg-white overflow-y-auto" style="height: 520px;"></div>
	</div>
</div>
