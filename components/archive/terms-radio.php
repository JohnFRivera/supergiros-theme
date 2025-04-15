<?php
$taxonomy_names = get_object_taxonomies( get_post_type(), 'names' );
if( !empty($taxonomy_names) ) {
	$post_type = get_post_type();
	$query = get_terms(array(
		'taxonomy' 		=> $taxonomy_names[0],
		'post_type' 	=> $post_type,
		'hide_empty' 	=> true,
	));
	
	if( !is_wp_error($query) && !empty($query) ) {
		$post_type_object = get_post_type_object($post_type);
		$term_slug = '';
		if( $post_type_object && isset($post_type_object->labels->all_items) ) {
			$all_items = (object) [ 'name' => $post_type_object->labels->all_items, 'slug' => '', 'count' => wp_count_posts($post_type)->publish ];
			array_unshift($query, $all_items);
		}
		if( is_tax() ) {
			$queried_object = get_queried_object();
			$term_slug = $queried_object->slug;
		}
		foreach( $query as $term ) {
			$href = site_url("{$post_type}/{$term->slug}/");
			$checked = $term_slug === $term->slug ? ' checked' : '';
			?>
			<div class="form-check position-relative">
				<input type="radio" class="form-check-input"<?php echo $checked; ?>/>
				<label class="form-check-label"><?php echo $term->name .' <span class="text-black-50">('. $term->count .')</span>'; ?></label>
				<a href="<?php echo $href; ?>" class="stretched-link"></a>
			</div>
			<?php
		}
	}
}