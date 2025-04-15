<?php
/**
 * Clase ThemeSuperGIROS_Login
 * 
 * Se encarga de crear los metodos que configuran opciones del login
 * 
 * @package supergiros
 */
class ThemeSuperGIROS_Login {

	public function __construct() {
		//
	}

	/**
	 * Se encarga de asignar una url al logo del login.
	 */
	public function login_headerurl() {
		return home_url();
	}

	/**
	 * Filtra el texto con su traducción.
	 * 
	 * @param string $translated_text
	 * @param string $text
	 * @param string $domain
	 * @return string
	 */
	public function gettext( $translated_text, $text, $domain ) {
		if ($text === 'Username or Email Address') {
			$translated_text = 'Usuario o correo electrónico';
		}
		return $translated_text;
	}

	/**
	 * Filtra la URL de redireccionamiento de inicio de sesión.
	 * 
	 * @param string $redirect_to
	 * @param string $requested_redirect_to
	 * @param WP_User|WP_Error $user
	 */
	public function login_redirect( $redirect_to, $requested_redirect_to, $user ) {
		return home_url();
	}

}
