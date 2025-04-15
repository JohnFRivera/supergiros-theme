<div class="container py-4">
	<section class="row mb-4">
		<div class="col">
			<?php get_template_part('/components/archive/terms-underline'); ?>
		</div>
		<div class="col-auto">
			<?php get_template_part('/components/archive/post-actions'); ?>
		</div>
	</section>
	<section class="mb-4" style="min-height: 795px;">
		<div id="posts" class="row row-cols-5 gutter"></div>
	</section>
	<section>
		<div class="col">
			<?php get_template_part('/components/archive/pagination'); ?>
		</div>
	</section>
</div>