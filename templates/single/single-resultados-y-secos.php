<?php
$lottery = get_the_terms( get_the_ID(), 'loterias' )[0];
$logotipo = get_term_meta($lottery->term_id, '_loteria_logotipo', true);
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
								<img class="img-fluid rounded-circle border" src="<?php echo $logotipo; ?>" alt="" />
							</div>
							<div>
								<h4 class="fw-bold mb-3"><?php echo $lottery->name; ?></h4>
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
