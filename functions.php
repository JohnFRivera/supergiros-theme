<?php
// Includes
require_once get_template_directory() . '/inc/class-customizer.php';
require_once get_template_directory() . '/inc/class-enqueues.php';
require_once get_template_directory() . '/inc/class-login.php';
require_once get_template_directory() . '/inc/class-routes.php';
require_once get_template_directory() . '/inc/class-shortcodes.php';
require_once get_template_directory() . '/inc/helpers.php';

// Routes
//require_once get_template_directory() . '/api/routes/consultas_routes.php';
//require_once get_template_directory() . '/api/routes/posts_routes.php';

class ThemeSuperGIROS_Functions {
	/**
	 * Nombre de dominio del tema.
	 * @var string
	 */
	private $domain;
	/**
	 * Clase del personalizador.
	 * @var ThemeSuperGIROS_Customizer
	 */
	private $customizer;
	/**
	 * Clase de encolamiento.
	 * @var ThemeSuperGIROS_Enqueues
	 */
	private $enqueues;
	/**
	 * Clase de encolamiento.
	 * @var ThemeSuperGIROS_Login
	 */
	private $login;
	/**
	 * Clase de Rest API.
	 * @var ThemeSuperGIROS_Routes
	 */
	private $routes;
	/**
	 * Clase de encolamiento.
	 * @var ThemeSuperGIROS_Shortcodes
	 */
	private $shortcodes;

	public function __construct() {
		$this->domain 		= 'intranet-supergiros';
		$this->enqueues 	= new ThemeSuperGIROS_Enqueues();
		$this->login 		= new ThemeSuperGIROS_Login();
		$this->routes 		= new ThemeSuperGIROS_Routes();
		$this->shortcodes 	= new ThemeSuperGIROS_Shortcodes();
		$this->add_hooks();
		$this->add_shortcodes();
	}

	/**
	 * Se encarga de añadir los hooks utilizados en el tema.
	 */
	private function add_hooks() {
		// Customizer
		add_action('customize_register', array($this, 'customize_register'));
		// Enqueues
		add_action('wp_head', 						array($this->enqueues, 'wp_head'));
		add_action('login_head', 					array($this->enqueues, 'login_head'));
		add_action('enqueue_block_editor_assets', 	array($this->enqueues, 'enqueue_block_editor_assets'));
		add_action('wp_enqueue_scripts', 			array($this->enqueues, 'wp_enqueue_scripts'));
		// Login
		add_filter('login_headerurl', 	array($this->login, 'login_headerurl'));
		add_filter('gettext', 			array($this->login, 'gettext'), 20, 3);
		add_filter('login_redirect', 	array($this->login, 'login_redirect'), 10, 3);
		// API
		add_action('rest_api_init', 	array($this, 'rest_api_init'));
		// Otros
		add_action('after_setup_theme', array($this, 'after_setup_theme'));
		add_filter('show_admin_bar', 	'__return_false');
	}

	/**
	 * Añade los shortcodes al tema.
	 */
	private function add_shortcodes() {
		add_shortcode('shortcode_sorteos_y_loterias', 	array($this->shortcodes, 'sorteos_y_loterias'));
		add_shortcode('shortcode_raspa_y_listo', 		array($this->shortcodes, 'raspa_y_listo'));
		add_shortcode('shortcode_utilidades', 			array($this->shortcodes, 'utilidades'));
	}

	/**
	 * Registra los paneles del personalizador.
	 * 
	 * @param WP_Customize_Manager $manager
	 */
	public function customize_register( $manager ) {
		$this->customizer = new ThemeSuperGIROS_Customizer($manager, $this->domain);
		$this->customizer->stylization();
		$this->customizer->social_media();
		$this->customizer->footer();
		$this->customizer->fonts();
		$this->customizer->carousel();
		$this->customizer->buttons();
		$this->customizer->ads();
	}

	/**
	 * Prepara la Rest Api de WordPress y permite registrar nuevas rutas.
	 */
	public function rest_api_init() {
		$this->routes->register_search_route();
		$this->routes->register_post_route();
		$this->routes->register_portafolio_route();
		$this->routes->register_noticias_route();
		$this->routes->register_loterias_route();
		$this->routes->register_documentos_route();
		// CONSULTAS EXTERNAS
		$this->routes->register_sorteos_y_loterias_route();
		$this->routes->register_raspa_y_listo_route();
		$this->routes->register_utilidades_route();
	}

	/**
	 * Se ejecuta despues de configurar el tema.
	 */
	public function after_setup_theme() {
		add_theme_support('post-thumbnails');
		add_theme_support('custom-logo');
		register_nav_menus(array(
			'nav-public'	=> 'Cabecera publica',
			'nav-private'	=> 'Cabecera privada',
			'nav-footer'	=> 'Pie de página',
		));
	}

}

if( class_exists('ThemeSuperGIROS_Functions') ) {
    $ThemeSuperGIROS_Functions = new ThemeSuperGIROS_Functions();
}
