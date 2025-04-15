<?php
/**
 * Clase ThemeSuperGIROS_Routes
 * 
 * Se encarga de contener los metodos que registran las rutas utilizadas en el tema.
 * 
 * @package supergiros
 */
require_once get_template_directory() . '/inc/class-controllers.php';

class ThemeSuperGIROS_Routes {
	/**
	 * Clase que contiene los controladores.
	 * @var ThemeSuperGIROS_Controllers
	 */
	private $controllers;

	public function __construct() {
		$this->controllers 				= new ThemeSuperGIROS_Controllers();
	}

	/**
	 * Registra las rutas en el WordPress.
	 * 
	 * @param string $route
	 * @param string $method
	 * @param string $callback
	 */
	private function register_route( $route, $method, $callback ) {
		register_rest_route('supergiros/v1', $route, array(
			'methods' 				=> $method,
			'callback' 				=> array($this->controllers, $callback),
			'permission_callback'	=> '__return_true',
		));
	}

	/**
	 * Registrar las rutas de la página Search.
	 */
	public function register_search_route() {
		$route = '/search/';
		$this->register_route($route, 'GET', 'get_search');
	}

	/**
	 * Resgistrar las rutas para los post por defecto de WordPress.
	 */
	public function register_post_route() {
		$route = '/post/';
		$this->register_route($route, 'GET', 	'get_post');
		$this->register_route($route, 'DELETE', 'delete_post');
	}

	/**
	 * Registrar las rutas del tipo de contenido Portafolio.
	 */
	public function register_portafolio_route() {
		$route = '/portafolio/';
		$this->register_route($route, 'GET', 'get_portafolio');
	}

	/**
	 * Registrar las rutas del tipo de contenido Noticias.
	 */
	public function register_noticias_route() {
		$route = '/noticias/';
		$this->register_route($route, 'GET', 'get_noticias');
	}

	/**
	 * Registrar las rutas para la sección de Loterías.
	 */
	public function register_loterias_route() {
		$route_resultados_y_secos 	= '/resultados-y-secos/';
		$route_planes_de_premios 	= '/planes-de-premios/';
		$this->register_route($route_resultados_y_secos, 	'GET', 'get_resultados_y_secos');
		$this->register_route($route_planes_de_premios, 	'GET', 'get_planes_de_premios');
	}

	/**
	 * Registrar las rutas del tipo de contenido Documentos.
	 */
	public function register_documentos_route() {
		$route = '/documentos/';
		$this->register_route($route, 'GET', 'get_documentos');
	}

	// CONSULTAS EXTERNAS

	/**
	 * Registrar las rutas para las consultas de Sorteos y Loterías.
	 */
	public function register_sorteos_y_loterias_route() {
		$route = '/sorteos-y-loterias/';
		$this->register_route("{$route}resultados/", 'GET', 'get_sorteos_y_loterias_resultados');
	}

	/**
	 * Registrar las rutas para las consultas de Raspa y Listo.
	 */
	public function register_raspa_y_listo_route() {
		$route = '/raspa-y-listo/';
		$this->register_route("{$route}inventario/", 	'GET', 'get_raspa_y_listo_inventario');
		$this->register_route("{$route}premios/", 		'GET', 'get_raspa_y_listo_premios');
		$this->register_route("{$route}fracciones/", 	'GET', 'get_raspa_y_listo_fracciones');
	}

	/**
	 * Registrar las rutas para las consulta de las Utilidades.
	 */
	public function register_utilidades_route() {
		$route = '/utilidades/';
		$this->register_route($route, 'POST', 'get_utilidades');
	}

}
