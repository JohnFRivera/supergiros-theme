<?php
$post_type = get_post_type();
$object_taxonomies = get_object_taxonomies( $post_type, 'names' );
if( !empty($object_taxonomies) ) {
	$post_id = get_the_ID();
	$taxonomy = $object_taxonomies[0];
	$post_terms = wp_get_post_terms( $post_id, $taxonomy );
	
	if( !is_wp_error($post_terms) && !empty($post_terms) ) {
		$args = array(
			'post_type'      => $post_type,
			'orderby'        => 'modified',
			'order'          => 'DESC',
			'posts_per_page' => 4,
			'post_status'    => 'publish',
			'post__not_in' 	 => array( $post_id ),
			'tax_query' 	 => array(
				array(
					'taxonomy'  => $taxonomy,
					'terms'     => $post_terms[0]->slug,
					'field'     => 'slug',
					'operators'	=> 'IN',
				),
			),
		);
		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			?>
			<div class="bg-body rounded border shadow overflow-hidden">
				<div class="py-2 px-3">
					<p class="fw-semibold mb-0">Más de <?php echo $post_terms[0]->name; ?></p>
				</div>
				<?php
				while( $query->have_posts() ) {
					$query->the_post();
					$title = get_the_title();
					?>
					<div class="item-hover border-top p-3 position-relative">
						<div class="hstack gap-3">
							<div class="w-25 ratio ratio-1x1">
								<img class="img-fluid object-fit-cover rounded border" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Portada de <?php echo $title; ?>">
							</div>
							<div class="w-75 vstack">
								<h6 class="fw-semibold lh-sm mb-1"><?php echo mb_substr($title, 0, 45) . (strlen($title) > 45 ? '...' : ''); ?></h6>
								<small class="text-black-50 mb-auto"><?php echo ucfirst( get_the_modified_date( 'F j, Y' ) ); ?></small>
							</div>
						</div>
						<a href="<?php echo get_the_permalink(); ?>" title="<?php echo $title; ?>" class="stretched-link"></a>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}	
	}
}
