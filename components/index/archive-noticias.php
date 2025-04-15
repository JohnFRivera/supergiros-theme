<?php
wp_enqueue_script(
	'noticias',
	get_template_directory_uri() . '/js/components/noticias.js',
	array(),
	null,
	true
);
?>
<div class="vstack justify-content-center py-5" style="min-height: 87.3vh;">
	<h4 class="text-center mb-5">Últimas Noticias</h4>
	<nav id="typesNews" class="nav nav-underline mb-4">
		<?php
		echo '<a href="#" class="nav-link link-primary border-3 fw-semibold pt-0 px-2 active">Todas las noticias</a>';
		$query = get_terms(array(
			'taxonomy' 		=> 'tipos_noticias',
			'post_type' 	=> 'noticias',
			'hide_empty' 	=> true,
		));
		foreach( $query as $term ) {
			echo '<a href="#' . $term->slug . '" class="nav-link link-primary border-3 fw-semibold pt-0 px-2">' . $term->name . '</a>';
		}
		?>
	</nav>
	<div class="vstack h-100">
		<div id="news" class="row row-cols-5 gutter"></div>
	</div>
</div>
