<?php
wp_enqueue_script(
	'pagination',
	get_template_directory_uri() . '/js/components/pagination.js',
	array(),
	null,
	true
);
?>
<div id="pagination" class="hstack align-items-center justify-content-between d-none">
	<a href="#prev" title="Anterior" id="btnPrev" class="btn btn-light rounded-circle shadow">
		<i class="bi bi-chevron-left"></i>
	</a>
	<div class="hstack gap-2">
		<input type="number" id="ipPage" class="form-control shadow-none" style="width: 70px;">
		<p class="mb-0">de <span id="txtLimit"></span></p>
	</div>
	<a href="#next" title="Siguiente" id="btnNext" class="btn btn-light rounded-circle shadow">
		<i class="bi bi-chevron-right"></i>
	</a>
</div>
