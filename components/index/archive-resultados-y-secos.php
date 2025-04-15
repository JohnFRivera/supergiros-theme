<?php
wp_enqueue_script(
	'resultados-y-secos',
	get_template_directory_uri() . '/js/components/resultados-y-secos.js',
	array(),
	null,
	true
);
?>
<div class="vstack justify-content-center py-5" style="min-height: 87.3vh;">
	<h4 class="text-center mb-5">Últimos Resultados y Secos de Loterías</h4>
	<div class="mb-5">
		<div id="lotteryDry" class="row row-cols-5 gutter"></div>
	</div>
</div>
