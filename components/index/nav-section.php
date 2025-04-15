<?php
$nav_items = array(
	array( 'text' => 'Carrusel de imagenes', 	'bi' => 'images', 		'top' => 214 ),
	array( 'text' => 'Últimas noticias', 		'bi' => 'newspaper', 	'top' => 994 ),
	array( 'text' => 'Resultados y secos', 		'bi' => 'ticket', 		'top' => 1826 ),
	array( 'text' => 'Resultados de loterías', 	'bi' => 'calendar', 	'top' => 2655 ),
	array( 'text' => 'Simulador de Chance', 	'bi' => 'calculator', 	'top' => 3488 ),
);
wp_enqueue_script(
	'nav-section',
	get_template_directory_uri() . '/js/components/nav-section.js',
	array(),
	null,
	true
);
?>
<div id="navSection" class="position-fixed top-50 end-0 translate-middle-y z-2">
	<div class="bg-body rounded shadow p-2 me-3">
		<div class="vstack gap-2">
			<?php
			foreach( $nav_items as $item ) {
				?>
				<button type="button" class="btn btn-secondary" data-top="<?php echo $item['top']; ?>" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="<?php echo $item['text']; ?>">
					<i class="bi bi-<?php echo $item['bi']; ?>"></i>
				</button>
				<?php
			}
			?>
		</div>
	</div>
</div>
