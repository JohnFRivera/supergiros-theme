<?php
get_header();
if( is_page('cumpleaneros') ) {
	wp_enqueue_script(
		'cumpleanos',
		get_template_directory_uri() . '/js/page/cumpleanos.js',
		array(),
		null,
		true
	);
}
?>
<main class="bg-body-tertiary">
	<div class="position-relative">
		<?php
		get_template_part('/components/page/page-actions');
		get_template_part('/components/page/page-thumbnail');
		?>
	</div>
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>
