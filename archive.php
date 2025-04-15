<?php
$post_type = supergiros_get_post_type();
$term = supergiros_get_term();

wp_enqueue_script(
	$post_type,
	get_template_directory_uri() . "/js/archive/{$post_type}.js",
	array(),
	null,
	true,
);

get_header();
?>
<main class="bg-body-tertiary">
	<input type="hidden" id="post-type" value="<?php echo $post_type; ?>">
	<input type="hidden" id="term" value="<?php echo $term; ?>">
	<?php get_template_part('/templates/archive/archive', $post_type); ?>
</main>
<?php
get_footer();
