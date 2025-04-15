<?php
$post_type 		= get_post_type();
$taxonomy_names = get_object_taxonomies( $post_type, 'names' );
if( !empty($taxonomy_names) ) {
	$post_terms = wp_get_post_terms( get_the_ID(), $taxonomy_names[0] );
	
	if( !is_wp_error($post_terms) && !empty($post_terms) ) {
		?>
		<p class="text-black-50 mt-3 mb-0">
			<i class="bi bi-tag"></i>
			<?php
			foreach ( $post_terms as $index => $term ) {
				$url = $post_type === 'post' ? "{$term->slug}/" : "{$post_type}/{$term->slug}/";
				$end_with = $index === (count($post_terms) - 1) ? '.' : ',';
				?>
				<a href="<?php echo site_url($url); ?>" class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover">
					<?php echo $term->name . $end_with; ?>
				</a>
				<?php
			}
			?>
		</p>
		<?php
	}
}
