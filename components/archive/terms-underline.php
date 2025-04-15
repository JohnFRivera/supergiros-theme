<?php
$post_type = get_post_type();
$WP_Taxonomy = get_object_taxonomies( $post_type, 'names' );
if( !empty($WP_Taxonomy) ) {
	$WP_Terms = get_terms(array(
		'taxonomy' 		=> $WP_Taxonomy[0],
		'post_type' 	=> $post_type,
		'hide_empty' 	=> true,
	));
	
	if( !is_wp_error($WP_Terms) && !empty($WP_Terms) ) {
		$WP_Post_Type = get_post_type_object($post_type);
		$term_slug = '';
		if( $WP_Post_Type && isset($WP_Post_Type->labels->all_items) ) {
			$all_items = (object) [ 'name' => $WP_Post_Type->labels->all_items, 'slug' => '' ];
			array_unshift($WP_Terms, $all_items);
		}
		if( is_tax() ) {
			$term_slug = get_queried_object()->slug;
		}
		?>
		<nav class="nav nav-underline gap-4">
			<?php
			foreach( $WP_Terms as $term ) {
				$href = site_url( "{$post_type}/{$term->slug}" );
				$active = $term_slug === $term->slug ? ' active' : '';
				echo '<a href="' . $href . '" class="nav-link link-primary border-3 fw-semibold' . $active . '">' . $term->name . '</a>';
			}
			?>
		</nav>
		<?php
	}
}
