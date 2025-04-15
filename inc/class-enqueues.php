<?php
/**
 * Clase ThemeSuperGIROS_Enqueues
 * 
 * Se encarga de manejar los encolamientos
 * 
 * @package supergiros
 */
class ThemeSuperGIROS_Enqueues {

	public function __construct() {
		//
	}

	/**
	 * Convierte un color Hexadecimal en formato RGB.
	 * 
	 * @param string $hex
	 * @return string
	 */
	private function hex_to_rgb( $hex ) {
		$hex = ltrim($hex, '#');
		if( strlen($hex) == 6 ) {
			list($r, $g, $b) = array(
				hexdec(substr($hex, 0, 2)),
				hexdec(substr($hex, 2, 2)),
				hexdec(substr($hex, 4, 2)),
			);
		} elseif( strlen($hex) == 3 ) {
			list($r, $g, $b) = array(
				hexdec(str_repeat(substr($hex, 0, 1), 2)),
				hexdec(str_repeat(substr($hex, 1, 1), 2)),
				hexdec(str_repeat(substr($hex, 2, 1), 2)),
			);
		}
		return "$r, $g, $b";
	}

	/**
	 * Obtiene los valores de modificación del personalizador.
	 * 
	 * @param array<array<array<string>>>
	 * @return array<array<string>>
	 */
	private function get_theme_mod( $panel ) {
		$mods = array();
		foreach( $panel as $section => $props ) {
			foreach( $props as $prop => $mod ) {
				$mods[$section][$prop] = get_theme_mod($mod[0],	$mod[1]);
			}
		}
		return $mods;
	}

	/**
	 * Obtiene las modificaciones de la estilización del personalizador.
	 * 
	 * @return array<array<string>>
	 */
	private function get_theme_stylization() {
		$mods = array(
			'colors' => array(
				'primary' 			=> array('color_primary', 			'#2f358b'),
				'secondary' 		=> array('color_secondary', 		'#ffd412'),
				'body' 				=> array('color_body', 				'#ffffff'),
				'body_secondary' 	=> array('color_body_secondary', 	'#dfeaff'),
				'body_tertiary' 	=> array('color_body_tertiary', 	'#eef4ff'),
				'title' 			=> array('color_title', 			'#000000'),
				'paragraph' 		=> array('color_paragraph', 		'#212529'),
			),
			'appearance' => array(
				'rounded' 	=> array('sl_appearance_rounded', 	'0.5rem'),
				'shadow' 	=> array('sl_appearance_shadow', 	'0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)'),
				'gutter' 	=> array('sl_appearance_gutter', 	'1.5rem'),
				'gap' 		=> array('sl_appearance_gap', 		'1.5rem'),
			),
		);
		return $this->get_theme_mod( $mods );
	}

	/**
	 * Obtiene las modificaciones de las fuentes del personalizador.
	 * 
	 * @return array<array<string>>
	 */
	private function get_theme_fonts() {
		$mods = array(
			'h1' => array(
				'fs' => array('txt_fs_h1', 	'calc(1.375rem + 1.5vw)'),
				'fw' => array('sl_fw_h1', 	'700'),
				'mb' => array('txt_mb_h1', 	'1.5rem'),
			),
			'h2' => array(
				'fs' => array('txt_fs_h2', 	'calc(1.325rem + 0.9vw)'),
				'fw' => array('sl_fw_h2', 	'700'),
				'mb' => array('txt_mb_h2', 	'1.5rem'),
			),
			'h3' => array(
				'fs' => array('txt_fs_h3', 	'calc(1.3rem + 0.6vw)'),
				'fw' => array('sl_fw_h3', 	'700'),
				'mb' => array('txt_mb_h3', 	'1.5rem'),
			),
			'h4' => array(
				'fs' => array('txt_fs_h4', 	'calc(1.275rem + 0.3vw)'),
				'fw' => array('sl_fw_h4', 	'700'),
				'mb' => array('txt_mb_h4', 	'1.5rem'),
			),
			'h5' => array(
				'fs' => array('txt_fs_h5', 	'1.25rem'),
				'fw' => array('sl_fw_h5', 	'700'),
				'mb' => array('txt_mb_h5', 	'1.5rem'),
			),
			'h6' => array(
				'fs' => array('txt_fs_h6', 	'1rem'),
				'fw' => array('sl_fw_h6', 	'700'),
				'mb' => array('txt_mb_h6', 	'0.5rem'),
			),
			'paragraph' => array(
				'fs' => array('txt_fs_paragraph', 	'1rem'),
				'fw' => array('sl_fw_paragraph', 	'400'),
				'mb' => array('txt_mb_paragraph', 	'1rem'),
			),
			'small' => array(
				'fs' => array('txt_fs_small', 	'0.875em'),
				'fw' => array('sl_fw_small', 	'400'),
				'mb' => array('txt_mb_small', 	'0.5rem'),
			),
		);
		return $this->get_theme_mod( $mods );
	}

	/**
	 * Obtiene las modificaciones de los botónes del personalizador.
	 * 
	 * @return array<array<string>>
	 */
	private function get_theme_buttons() {
		$mods = array(
			'globals' => array(
				'fs' 		=> array('txt_btn_fs', 			'1rem'),
				'fw' 		=> array('sl_btn_fw', 			'400'),
				'rounded' 	=> array('sl_btn_rounded', 		'0.375rem'),
				'padding_x' => array('txt_btn_padding_x', 	'0.75rem'),
				'padding_y' => array('txt_btn_padding_y', 	'0.375rem'),
			),
			'primary' => array(
				'text' 			=> array('color_btn_primary_text', 			'#FFFFFF'),
				'bg' 			=> array('color_btn_primary_bg', 			'#2F358B'),
				'border' 		=> array('color_btn_primary_border', 		'#2F358B'),
				'hover_text' 	=> array('color_btn_hover_primary_text', 	'#FFFFFF'),
				'hover_bg' 		=> array('color_btn_hover_primary_bg', 		'#323562'),
				'hover_border' 	=> array('color_btn_hover_primary_border', 	'#323562'),
				'active_text' 	=> array('color_btn_active_primary_text', 	'#FFFFFF'),
				'active_bg' 	=> array('color_btn_active_primary_bg', 	'#252637'),
				'active_border' => array('color_btn_active_primary_border', '#252637'),
			),
			'secondary' => array(
				'text' 			=> array('color_btn_secondary_text', 			'#000000'),
				'bg' 			=> array('color_btn_secondary_bg', 				'#FFD412'),
				'border' 		=> array('color_btn_secondary_border', 			'#FFD412'),
				'hover_text' 	=> array('color_btn_hover_secondary_text', 		'#000000'),
				'hover_bg' 		=> array('color_btn_hover_secondary_bg', 		'#D5B732'),
				'hover_border' 	=> array('color_btn_hover_secondary_border', 	'#D5B732'),
				'active_text' 	=> array('color_btn_active_secondary_text', 	'#000000'),
				'active_bg' 	=> array('color_btn_active_secondary_bg', 		'#AA9745'),
				'active_border' => array('color_btn_active_secondary_border', 	'#AA9745'),
			),
		);
		return $this->get_theme_mod( $mods );
	}

	/**
	 * Encola los scripts.
	 * 
	 * @param string $handle
	 * @param string $src
	 */
	private function enqueue_script( $handle, $src ) {
		wp_enqueue_script($handle, get_template_directory_uri() . "/js/{$src}", array(), null, true);
	}

	/**
	 * Encola scripts en la cabecera del front-end.
	 */
	public function wp_head() {
		$stylization 	= $this->get_theme_stylization();
		$fonts 			= $this->get_theme_fonts();
		$buttons 		= $this->get_theme_buttons();
		echo "
		<style>
			:root {
				--bs-primary: 			{$stylization['colors']['primary']};
				--bs-primary-rgb: 		{$this->hex_to_rgb($stylization['colors']['primary'])};
				--bs-secondary: 		{$stylization['colors']['secondary']};
				--bs-secondary-rgb: 	{$this->hex_to_rgb($stylization['colors']['secondary'])};
				--bs-heading-color: 	{$stylization['colors']['title']};
				--bs-body-color: 		{$stylization['colors']['paragraph']};
				--bs-body-color-rgb: 	{$this->hex_to_rgb($stylization['colors']['paragraph'])};
				--bs-body-bg: 			{$stylization['colors']['body']};
				--bs-body-bg-rgb: 		{$this->hex_to_rgb($stylization['colors']['body'])};
				--bs-secondary-bg: 		{$stylization['colors']['body_secondary']};
				--bs-secondary-bg-rgb: 	{$this->hex_to_rgb($stylization['colors']['body_secondary'])};
				--bs-tertiary-bg: 		{$stylization['colors']['body_tertiary']};
				--bs-tertiary-bg-rgb: 	{$this->hex_to_rgb($stylization['colors']['body_tertiary'])};
				--sg-border-radius: 	{$stylization['appearance']['rounded']};
			}
			h1 {
				font-size: 		{$fonts['h1']['fs']};
				font-weight: 	{$fonts['h1']['fw']};
				margin-bottom: 	{$fonts['h1']['mb']};
			}
			h2 {
				font-size: 		{$fonts['h2']['fs']};
				font-weight: 	{$fonts['h2']['fw']};
				margin-bottom: 	{$fonts['h2']['mb']};
			}
			h3 {
				font-size: 		{$fonts['h3']['fs']};
				font-weight: 	{$fonts['h3']['fw']};
				margin-bottom: 	{$fonts['h3']['mb']};
			}
			h4 {
				font-size: 		{$fonts['h4']['fs']};
				font-weight: 	{$fonts['h4']['fw']};
				margin-bottom: 	{$fonts['h4']['mb']};
			}
			h5 {
				font-size: 		{$fonts['h5']['fs']};
				font-weight: 	{$fonts['h5']['fw']};
				margin-bottom: 	{$fonts['h5']['mb']};
			}
			h6 {
				font-size: 		{$fonts['h6']['fs']};
				font-weight: 	{$fonts['h6']['fw']};
				margin-bottom: 	{$fonts['h6']['mb']};
			}
			p {
				font-size: 		{$fonts['paragraph']['fs']};
				font-weight: 	{$fonts['paragraph']['fw']};
				margin-bottom: 	{$fonts['paragraph']['mb']};
			}
			small {
				font-size: 		{$fonts['small']['fs']};
				font-weight: 	{$fonts['small']['fw']};
				margin-bottom: 	{$fonts['small']['mb']};
			}

			.rounded {
				border-radius: 	{$stylization['appearance']['rounded']} !important;
			}
			.shadow {
				box-shadow: 	{$stylization['appearance']['shadow']} !important;
			}
			.gutter {
				--bs-gutter-x: 	{$stylization['appearance']['gutter']} !important;
				--bs-gutter-y: 	{$stylization['appearance']['gutter']} !important;
			}
			.gap {
				gap: 			{$stylization['appearance']['gap']} !important;
			}

			.btn {
				font-size: 		{$buttons['globals']['fs']};
				font-weight: 	{$buttons['globals']['fw']};
				border-radius: 	{$buttons['globals']['rounded']};
				padding: 		{$buttons['globals']['padding_y']} {$buttons['globals']['padding_x']};
			}
			.btn-primary {
				--bs-btn-color: 				{$buttons['primary']['text']};
				--bs-btn-bg: 					{$buttons['primary']['bg']};
				--bs-btn-border-color: 			{$buttons['primary']['border']};
				--bs-btn-hover-color: 			{$buttons['primary']['hover_text']};
				--bs-btn-hover-bg: 				{$buttons['primary']['hover_bg']};
				--bs-btn-hover-border-color: 	{$buttons['primary']['hover_border']};
				--bs-btn-active-color: 			{$buttons['primary']['active_text']};
				--bs-btn-active-bg: 			{$buttons['primary']['active_bg']};
				--bs-btn-active-border-color: 	{$buttons['primary']['active_border']};
				--bs-btn-disabled-color: 		{$buttons['primary']['text']};
				--bs-btn-disabled-bg: 			{$buttons['primary']['bg']};
				--bs-btn-disabled-border-color: {$buttons['primary']['border']};
				box-shadow: none !important;
			}
			.btn-outline-primary {
				--bs-btn-color: 				{$buttons['primary']['bg']};
				--bs-btn-bg: 					transparent;
				--bs-btn-border-color: 			{$buttons['primary']['border']};
				--bs-btn-hover-color: 			{$buttons['primary']['text']};
				--bs-btn-hover-bg: 				{$buttons['primary']['bg']};
				--bs-btn-hover-border-color: 	{$buttons['primary']['border']};
				--bs-btn-active-color: 			{$buttons['primary']['hover_text']};
				--bs-btn-active-bg: 			{$buttons['primary']['hover_bg']};
				--bs-btn-active-border-color: 	{$buttons['primary']['hover_border']};
				--bs-btn-disabled-color: 		{$buttons['primary']['bg']};
				--bs-btn-disabled-bg: 			transparent;
				--bs-btn-disabled-border-color: {$buttons['primary']['border']};
				box-shadow: none !important;
			}
			.btn-secondary {
				--bs-btn-color: 				{$buttons['secondary']['text']};
				--bs-btn-bg: 					{$buttons['secondary']['bg']};
				--bs-btn-border-color: 			{$buttons['secondary']['border']};
				--bs-btn-hover-color: 			{$buttons['secondary']['hover_text']};
				--bs-btn-hover-bg: 				{$buttons['secondary']['hover_bg']};
				--bs-btn-hover-border-color: 	{$buttons['secondary']['hover_border']};
				--bs-btn-active-color: 			{$buttons['secondary']['active_text']};
				--bs-btn-active-bg: 			{$buttons['secondary']['active_bg']};
				--bs-btn-active-border-color: 	{$buttons['secondary']['active_border']};
				--bs-btn-disabled-color: 		{$buttons['secondary']['text']};
				--bs-btn-disabled-bg: 			{$buttons['secondary']['bg']};
				--bs-btn-disabled-border-color: {$buttons['secondary']['border']};
				box-shadow: none !important;
			}
			.btn-outline-secondary {
				--bs-btn-color: 				{$buttons['secondary']['bg']};
				--bs-btn-bg: 					transparent;
				--bs-btn-border-color: 			{$buttons['secondary']['border']};
				--bs-btn-hover-color: 			{$buttons['secondary']['text']};
				--bs-btn-hover-bg: 				{$buttons['secondary']['bg']};
				--bs-btn-hover-border-color: 	{$buttons['secondary']['border']};
				--bs-btn-active-color: 			{$buttons['secondary']['hover_text']};
				--bs-btn-active-bg: 			{$buttons['secondary']['hover_bg']};
				--bs-btn-active-border-color: 	{$buttons['secondary']['hover_border']};
				--bs-btn-disabled-color: 		{$buttons['secondary']['bg']};
				--bs-btn-disabled-bg: 			transparent;
				--bs-btn-disabled-border-color: {$buttons['secondary']['border']};
				box-shadow: none !important;
			}
			
			/* WordPress */
			.wp-block-columns {
				gap: {$stylization['appearance']['gap']};
			}
			.wp-block-column {
				position: relative;
				background-color: var(--bs-body-bg) !important;
				border: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color)!important;
				border-radius: 	{$stylization['appearance']['rounded']};
				box-shadow: 	{$stylization['appearance']['shadow']};
				padding: 1.5rem !important;
				transition: all 0.4s ease;
			}
			.wp-block-column:hover {
				color: var(--bs-primary) !important;
				border: var(--bs-border-width) var(--bs-border-style) rgba(var(--bs-primary-rgb), 0.7) !important;
				border-radius: 	{$stylization['appearance']['rounded']};
				box-shadow: 0 .35rem .4rem rgba(0, 0, 0, .2) !important;
				transform: translatey(-4px);
			}
		</style>";
	}

	/**
	 * Encola scripts en el front-end del login.
	 */
	public function login_head() {
		$custom_logo = wp_get_attachment_url(get_theme_mod('custom_logo'));
		$stylization = $this->get_theme_stylization();
		echo "
		<style type='text/css'>
			/* Fondo */
			body {
				background-color:	{$stylization['colors']['primary']};
			}
			#login {
				padding-top:		150px !important;
			}

			/* Logotipo */
			.login h1 a {
				background-image:	url({$custom_logo});
				background-size:	contain;
				width:				209px;
			}

			/* Formulario */
			.login form {
				background-color:	{$stylization['colors']['body_tertiary']} !important;
				border:				0;
				padding:			20px;
				border-radius:		0.25rem;
			}

			/* Labels del formulario */
			.login label {
				color:				#333;
				font-size:			16px;
			}

			/* Inputs del formulario */
			.login form .input, .login input[type=password], .login input[type=text] {
				font-size:			16px !important;
				border: 			1px !important;
				border-radius: 		0.25rem !important;
				padding: 			6px 16px !important;
				margin-bottom: 		6px !important;
				box-shadow: 		rgba(0, 0, 0, 0.075) 0px 2px 4px 0px !important;
			}
			.login form .input:focus, .login input[type=password]:focus, .login input[type=text]:focus {
				border: 			1px solid {$stylization['colors']['primary']} !important;
			}

			/* Botones */
			.wp-core-ui .button, .wp-core-ui .button-primary, .wp-core-ui .button-secondary {
				width: 				100%;
				font-size: 			16px;
				padding: 			2px 0px !important;
				transition: 		all 0.15s 0s ease-in-out;
			}
			.wp-core-ui .button-primary {
				background-color: 	{$stylization['colors']['primary']}; /* Cambia el color del botón */
				border-color: 		{$stylization['colors']['primary']};
				margin-top: 		12px !important;
			}
			.wp-core-ui .button-primary:hover {
				background-color: 	{$stylization['colors']['primary']}; /* Cambia el color del botón */
				border-color: 		{$stylization['colors']['primary']};
				filter: 			brightness(1.25) !important;
			}

			/* Links */
			.login #nav {
				display: 			flex;
				justify-content:	center;
				color: 				#ffffff;
				gap: 				0.5rem;
			}
			#nav > a {
				color: 				rgba(255,255,255,0.5) !important;
				text-wrap: 			nowrap;
				font-size: 			16px !important;
				transition: 		all 0.15s 0s ease-in-out;
			}
			#nav > a:hover {
				color: 				rgba(255,255,255,1) !important;
			}
			.login #backtoblog a {
				display: 			flex;
				justify-content: 	center;
				color: 				rgba(255,255,255,0.5) !important;
			}
			.login #backtoblog a:hover {
				color: 				rgba(255,255,255,1) !important;
			}
			.login .privacy-policy-link {
				color: 				rgba(255,255,255,0.5) !important;
			}
			.login .privacy-policy-link:hover {
				color: 				rgba(255,255,255,1) !important;
			}
			.language-switcher {
				display: 			none !important;
			}
		</style>";
	}

	/**
	 * Encola scripts en el editor Guttenberg
	 */
	public function enqueue_block_editor_assets() {
		wp_enqueue_style(
			'block-editor-style',
			get_template_directory_uri() . '/block-editor-style.css',
			array(),
			'',
			'all'
		);
		$stylization 	= $this->get_theme_stylization();
		$fonts 			= $this->get_theme_fonts();
		$buttons 		= $this->get_theme_buttons();
		echo "
		<style>
			:root {
				--bs-primary: 			{$stylization['colors']['primary']};
				--bs-primary-rgb: 		{$this->hex_to_rgb($stylization['colors']['primary'])};
				--bs-secondary: 		{$stylization['colors']['secondary']};
				--bs-secondary-rgb: 	{$this->hex_to_rgb($stylization['colors']['secondary'])};
				--bs-heading-color: 	{$stylization['colors']['title']};
				--bs-body-color: 		{$stylization['colors']['paragraph']};
				--bs-body-color-rgb: 	{$this->hex_to_rgb($stylization['colors']['paragraph'])};
				--bs-body-bg: 			{$stylization['colors']['body']};
				--bs-body-bg-rgb: 		{$this->hex_to_rgb($stylization['colors']['body'])};
				--bs-secondary-bg: 		{$stylization['colors']['body_secondary']};
				--bs-secondary-bg-rgb: 	{$this->hex_to_rgb($stylization['colors']['body_secondary'])};
				--bs-tertiary-bg: 		{$stylization['colors']['body_tertiary']};
				--bs-tertiary-bg-rgb: 	{$this->hex_to_rgb($stylization['colors']['body_tertiary'])};
				--sg-border-radius: 	{$stylization['appearance']['rounded']};
			}
			.wp-block {
				margin-top: 0 !important;
			}
			.wp-block-button__link {
				--bs-btn-padding-x: {$buttons['globals']['padding_x']};
				--bs-btn-padding-y: {$buttons['globals']['padding_y']};
				--bs-btn-font-size: {$buttons['globals']['fs']};
				--bs-btn-font-weight: {$buttons['globals']['fw']};
				--bs-btn-line-height: 1.5;
				--bs-btn-border-width: 1px;
				--bs-btn-border-color: transparent;
				--bs-btn-border-radius: {$buttons['globals']['rounded']};
				display: inline-block;
				padding: var(--bs-btn-padding-y) var(--bs-btn-padding-x) !important;
				font-size: var(--bs-btn-font-size) !important;
				font-weight: var(--bs-btn-font-weight) !important;
				line-height: var(--bs-btn-line-height) !important;
				text-align: center !important;
				text-decoration: none !important;
				vertical-align: middle !important;
				-webkit-user-select: none !important;
				-moz-user-select: none !important;
				user-select: none !important;
				border: var(--bs-btn-border-width) solid var(--bs-btn-border-color) !important;
				border-radius: var(--bs-btn-border-radius) !important;
			}
			h1.block-editor-rich-text__editable {
				font-size: 		{$fonts['h1']['fs']};
				font-weight: 	{$fonts['h1']['fw']};
				line-height: 	1.5;
				margin-bottom: 	{$fonts['h1']['mb']};
			}
			h2.block-editor-rich-text__editable {
				font-size: 		{$fonts['h2']['fs']};
				font-weight: 	{$fonts['h2']['fw']};
				line-height: 	1.5;
				margin-bottom: 	{$fonts['h2']['mb']};
			}
			h3.block-editor-rich-text__editable {
				font-size: 		{$fonts['h3']['fs']};
				font-weight: 	{$fonts['h3']['fw']};
				line-height: 	1.5;
				margin-bottom: 	{$fonts['h3']['mb']};
			}
			h4.block-editor-rich-text__editable {
				font-size: 		{$fonts['h4']['fs']};
				font-weight: 	{$fonts['h4']['fw']};
				line-height: 	1.5;
				margin-bottom: 	{$fonts['h4']['mb']};
			}
			h5.block-editor-rich-text__editable {
				font-size: 		{$fonts['h5']['fs']};
				font-weight: 	{$fonts['h5']['fw']};
				line-height: 	1.5;
				margin-bottom: 	{$fonts['h5']['mb']};
			}
			h6.block-editor-rich-text__editable {
				font-size: 		{$fonts['h6']['fs']};
				font-weight: 	{$fonts['h6']['fw']};
				line-height: 	1.5;
				margin-bottom: 	{$fonts['h6']['mb']};
			}
			p.block-editor-rich-text__editable {
				font-size: 		{$fonts['paragraph']['fs']};
				font-weight: 	{$fonts['paragraph']['fw']};
				line-height: 	1.5;
				margin-bottom: 	{$fonts['paragraph']['mb']};
			}
			p > a {
			  color: rgb(13, 110, 253) !important;
			}
			ol.block-editor-block-list__block {
				font-size: 	{$fonts['paragraph']['fs']};
				margin-top: 0 !important;
			}
			li.block-editor-block-list__block {
				margin-left: 0 !important;
			}
			.wp-block-columns {
				gap: {$stylization['appearance']['gap']};
			}
			.wp-block-column {
				position: relative;
				background-color: var(--bs-body-bg) !important;
				border: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color)!important;
				border-radius: 	{$stylization['appearance']['rounded']};
				box-shadow: 	{$stylization['appearance']['shadow']};
				padding: 1.5rem !important;
				transition: all 0.4s ease;
			}
			.wp-block-column:hover {
				color: var(--bs-primary) !important;
				border: var(--bs-border-width) var(--bs-border-style) rgba(var(--bs-primary-rgb), 0.7) !important;
				border-radius: 	{$stylization['appearance']['rounded']};
				box-shadow: 0 .35rem .4rem rgba(0, 0, 0, .2) !important;
				transform: translatey(-4px);
			}
			
			.rounded {
				border-radius: 	{$stylization['appearance']['rounded']};
			}
			.shadow {
				box-shadow: 	{$stylization['appearance']['shadow']};
			}
			.gutter {
				--bs-gutter-x: 	{$stylization['appearance']['gutter']};
				--bs-gutter-y: 	{$stylization['appearance']['gutter']};
			}
			.gap {
				gap: 			{$stylization['appearance']['gap']};
			}
		</style>";
	}

	/**
	 * Se encarga de encolar los estilos y scripts del tema.
	 */
	public function wp_enqueue_scripts() {
		// Dependencias
		wp_enqueue_script('jquery');
		wp_enqueue_style('bootstrap-styles', 		get_template_directory_uri() . '/assets/vendor/bootstrap/bootstrap.min.css', 					array(), '5.3.3', 'all');
		wp_enqueue_script('bootstrap-bundle',		get_template_directory_uri() . '/assets/vendor/bootstrap/bootstrap.bundle.min.js', 				array(), '5.3.3', true);
		wp_enqueue_style('bootstrap-icons-styles',	get_template_directory_uri() . '/assets/vendor/bootstrap-icons/font/bootstrap-icons.min.css',	array(), '1.13.3', 'all');
		// Tema
		wp_enqueue_style('supergiros-styles',	get_stylesheet_uri());
		$this->enqueue_script('constans', 		'utils/constans.js');
		$this->enqueue_script('local-storage', 	'utils/localStorage.js');
		$this->enqueue_script('fetch', 			'utils/fetch.js');
	}

}
