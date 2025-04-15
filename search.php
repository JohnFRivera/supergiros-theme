<?php
get_header();
wp_enqueue_script(
	'results',
	get_template_directory_uri() . '/js/search/results.js',
	array(),
	null,
	true
);
?>
<main>
	<?php get_template_part('/components/index/searcher'); ?>
	<div class="bg-body-tertiary py-4">
		<div class="container">
			<div class="row mb-4">
				<div class="col">
					<p class="text-primary text-center fw-semibold fs-5 mb-0">Resultados para "<?php echo get_search_query(); ?>"</p>
				</div>
			</div>
			<div style="min-height: 795px;">
				<div id="results" class="row row-cols-4 gutter"></div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>
