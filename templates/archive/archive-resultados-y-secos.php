<div class="container py-4">
	<section class="row mt-4 mb-1">
		<div class="col">
			<p class="text-center fs-5 mb-0">Lotería</p>
			<h4 class="text-center fw-bold mb-4">Resultados y Secos</h4>
		</div>
	</section>
	<section class="row mb-4">
		<div class="col">
			<div class="hstack gap-3">
				<select id="slLottery" class="form-select w-auto rounded shadow">
					<option value="">Todas las loterías</option>
					<?php
					$terms = get_terms(array(
						'taxonomy' 		=> 'loterias',
						'post_type' 	=> 'planes-de-premios',
						'hide_empty' 	=> true,
					));
					foreach( $terms as $term ) {
						echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
					};
					?>
				</select>
				<select id="slYear" class="form-select w-auto rounded shadow">
					<option value="">Todos los años</option>
				</select>
				<select id="slMonth" class="form-select w-auto rounded shadow" style="display: none;"></select>
				<select id="slDay" class="form-select w-auto rounded shadow" style="display: none;"></select>
			</div>
		</div>
		<div class="col-auto">
			<?php get_template_part('/components/archive/post-actions'); ?>
		</div>
	</section>
	<section class="mb-4" style="height: 386px;">
		<div id="lotteries" class="row row-cols-5 gutter"></div>
	</section>
	<section class="row">
		<div class="col">
			<?php get_template_part('/components/archive/pagination'); ?>
		</div>
	</section>
</div>
