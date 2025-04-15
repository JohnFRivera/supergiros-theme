<?php
$ID = get_the_ID();
$title = get_the_title();
$thumbnail_url = get_the_post_thumbnail_url();
?>
<main class="bg-body-secondary py-4">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="bg-body rounded border shadow">
					<div class="position-relative border-bottom p-4">
						<?php get_template_part('/components/single/post-actions'); ?>
						<div class="hstack gap-4">
							<div class="ratio ratio-1x1" style="width: 96px;">
								<img class="img-fluid rounded-circle border" src="<?php echo $thumbnail_url; ?>" alt="" />
							</div>
							<div>
								<h4 class="fw-bold mb-3"><?php echo $title; ?></h4>
								<?php get_template_part('/components/single/post-detail'); ?>
							</div>
						</div>
					</div>
					<div class="p-4">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>