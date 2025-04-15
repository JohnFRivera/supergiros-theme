<div class="container py-4">
	<section class="row">
		<div class="col">
			<p class="d-inline-block border-bottom border-3 border-primary text-primary fw-semibold pb-2 mb-4">Destacadas</p>
		</div>
		<div class="col-auto">
			<?php get_template_part('/components/archive/post-actions'); ?>
		</div>
	</section>
	<section class="row row-cols-2 mb-5" style="min-height: 500px;">
		<div id="mainNotice" class="col"></div>
		<div class="col">
			<div id="submainNotices" class="row row-cols-2 gutter"></div>
		</div>
	</section>
	<section class="row mb-4">
		<div class="col">
			<?php get_template_part('/components/archive/terms-underline'); ?>
		</div>
		<div class="col-auto">
			<?php get_template_part('/components/archive/post-search'); ?>
		</div>
	</section>
	<section class="mb-4" style="height: 795px;">
		<div id="notices" class="row row-cols-5 gutter"></div>
	</section>
	<section>
		<div class="col">
			<?php get_template_part('/components/archive/pagination'); ?>
		</div>
	</section>
</div>
