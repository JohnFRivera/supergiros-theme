<?php
$post_type 		= get_post_type();
$taxonomy_names = get_object_taxonomies( $post_type, 'names' );
if( !empty($taxonomy_names) && isset($taxonomy_names[1]) ) {
	$post_terms = wp_get_post_terms( get_the_ID(), $taxonomy_names[1] );
	
	if( !is_wp_error($post_terms) && !empty($post_terms) ) {
		?>
		<div class="bg-body rounded border shadow">
			<div class="border-bottom py-2 px-3">
				<p class="fw-semibold mb-0">Temas relacionados</p>
			</div>
			<div class="p-3">
				<div class="hstack gap-3">
					<?php
					foreach ( $post_terms as $term ) {
						echo '<a href="'. site_url( "{$post_type}/{$term->slug}/" ) .'" class="btn btn-outline-primary py-1">'. $term->name .'</a>';
					}
					?>
				</div>
			</div>
		</div>
		<?php
	}
}
