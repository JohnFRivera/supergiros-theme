<?php
/**
 * Clase ThemeSuperGIROS_Shortcodes
 * 
 * Se encarga de crear los shortcodes reutilizables para el tema
 * 
 * @package supergiros
 */
class ThemeSuperGIROS_Shortcodes {

	public function __construct() {
		//
	}

	/**
	 * Shortcode para Sorteos y Loterías.
	 * 
	 * @param array $atts
	 */
	public function sorteos_y_loterias( $atts ) {
		$atts = shortcode_atts(
			array( 'query' => 'resultados' ),
			$atts
		);
		switch( $atts['query'] ) {
			case 'resultados':
				wp_enqueue_script('sorteos-y-loterias', get_template_directory_uri() . '/js/consultas/sorteos-y-loterias-resultados.js', array(), null, true);
				?>
				<div class="rounded border shadow overflow-hidden my-4">
					<div class="bg-body-secondary bg-gradient p-4">
						<div class="row">
							<div class="col">
								<div class="hstack gap-2">
									<label for="resultsDate" class="text-black">Fecha:</label>
									<input type="date" id="resultsDate" class="form-control rounded border shadow" style="width: 240px;">
								</div>
							</div>
							<div class="col-auto ms-auto">
								<div class="hstack gap-2">
									<label for="slOrder" class="text-black text-nowrap">Ordenar por:</label>
									<?php get_template_part('/components/archive/order-select'); ?>
								</div>
							</div>
							<div class="col-auto">
								<?php get_template_part('/components/archive/post-search'); ?>
							</div>
						</div>
					</div>
					<div class="bg-body">
						<div id="lotteryResults" class="overflow-y-auto" style="height: 600px;"></div>
					</div>
				</div>
				<?php
				break;
		}
	}

	/**
	 * Shortcode para Raspa y Listo.
	 * 
	 * @param array $atts
	 */
	public function raspa_y_listo( $atts ) {
		$atts = shortcode_atts(
			array( 'query' => 'inventario' ),
			$atts
		);
		wp_enqueue_script( "raspa-y-listo-{$atts['query']}", get_template_directory_uri() . "/js/consultas/raspa-y-listo-{$atts['query']}.js", array(), null, true );
		?><div class="container align-content-center" id="container" style="min-height: 280px;"></div><?php
	}

	/**
	 * Shortcode para sección de Utilidades.
	 */
	public function utilidades() {
		?><script><?php echo is_user_logged_in() ?> !== 1 && (window.location.href = '/');</script><?php
		wp_enqueue_script( 'utilidades',get_template_directory_uri() . '/js/consultas/utilidades.js', 	array(), null, true );
		$username = supergiros_encrypt(wp_get_current_user()->user_login, 'Sagitario-A*');
		?>
		<div>
			<input type="hidden" id="u" value="<?php echo $username; ?>" />
			<div style="min-height: 382.38px;">
				<div id="utilities" class="grid-container gap"></div>
			</div>
		</div>
		<?php
	}

}
