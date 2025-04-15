<div class="container py-4">
	<section class="row mt-4 mb-1">
		<div class="col">
			<p class="text-center fs-5 mb-0">Lotería</p>
			<h4 class="text-center fw-bold mb-4">Planes de Premios</h4>
		</div>
	</section>
	<section class="row mb-4">
		<div class="col-auto ms-auto">
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
