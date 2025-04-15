<div class="bg-body-secondary py-4">
	<div class="container">
		<div class="row">
			<main class="col">
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
						<div class="ratio ratio-16x9 mb-4">
							<img class="img-fluid rounded border" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Portada de <?php echo get_the_title(); ?>">
						</div>
						<?php the_content(); ?>
					</div>
				</div>
			</main>
			<aside class="col-3">
				<div class="vstack gap-4">
					<?php
					get_template_part('/components/single/social-media');
					get_template_part('/components/single/post-list');
					get_template_part('/components/single/post-tags');
					get_template_part('/components/single/post-ads');
					?>
				</div>
			</aside>
		</div>
	</div>
</div>
