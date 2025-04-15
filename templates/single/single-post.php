<main class="bg-body-secondary py-4">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="bg-body rounded border shadow overflow-hidden">
					<div class="position-relative border-bottom p-4">
						<?php
						get_template_part('/components/single/post-actions');
						get_template_part('/components/single/post-title');
						get_template_part('/components/single/post-detail');
						get_template_part('/components/single/post-categories');
						?>
					</div>
					<div class="p-4">
						<?php the_content(); ?>
					</div>
				</div>
			</main>
		</div>
	</div>
</main>
