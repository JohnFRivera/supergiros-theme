<div class="container py-4">
	<div class="row gap-3">
		<aside class="col-auto">
			<div class="sticky-top vstack gap-4">
				<div>
					<h6 class="fw-semibold mb-2">Clasificaciones</h6>
					<?php get_template_part('/components/archive/terms-radio'); ?>
				</div>
				<div>
					<label for="slOrder" class="fw-semibold mb-2">Ordenar por</label>
					<?php get_template_part('/components/archive/order-select'); ?>
				</div>
				<div>
					<label for="ipPage" class="fw-semibold mb-2">Paginación</label>
					<?php get_template_part('/components/archive/pagination'); ?>
				</div>
			</div>
		</aside>
		<main class="col">
			<section class="row mb-4">
				<div class="col-auto">
					<?php get_template_part('/components/archive/post-actions'); ?>
				</div>
				<div class="col-auto ms-auto">
					<?php get_template_part('/components/archive/post-search'); ?>
				</div>
			</section>
			<section class="mb-4" style="min-height: 1239px;">
				<div id="documents" class="row row-cols-5 gutter"></div>
			</section>
		</main>
	</div>
</div>
