<?php
/**
 * Clase ThemeSuperGIROS_Customizer
 * 
 * Se encarga de crear los metodos que registren los distintos paneles del personalizador.
 * 
 * @package supergiros
 */
class ThemeSuperGIROS_Customizer {
	/**
	 * Clase con el manejador del personalizador.
	 * @var WP_Customize_Manager
	 */
	private $manager;
	/**
	 * Nombre de dominio del plugin.
	 * @var string
	 */
	private $domain;

	/**
	 * Constructor de la clase Customizer del tema.
	 * 
	 * @param WP_Customize_Manager $manager
	 */
	public function __construct( $manager, $domain ) {
		$this->manager 	= $manager;
		$this->domain 	= $domain;
	}

	/**
	 * Añade un panel en el personalizador.
	 * 
	 * @param string $id
	 * @param string $title
	 * @param string $description
	 */
	private function add_panel( $id, $title, $description ) {
		$this->manager->add_panel("panel_{$id}", array(
			'title'			=> __($title),
			'description'	=> $description,
			'priority'		=> 30,
		));
	}

	/**
	 * Añade una sección en un panel.
	 * 
	 * @param string $id
	 * @param string $title
	 * @param string $panel
	 */
	private function add_section( $id, $title, $panel ) {
		$this->manager->add_section("section_{$id}", array(
			'title'		=> __($title, $this->domain),
			'panel'		=> !empty($panel) ? "panel_{$panel}" : '',
		));
	}

	/**
	 * Añade un control de texto a una sección.
	 * 
	 * @param string $id
	 * @param string $default
	 * @param string $label
	 * @param string $section
	 */
	private function add_text_control( $id, $default, $label, $section ) {
		$this->manager->add_setting("txt_{$id}", array(
			'default'			=> $default,
			'sanitize_callback' => 'sanitize_text_field',
		));
		$this->manager->add_control("txt_{$id}_control", array(
			'label'				=> __($label, $this->domain),
			'section'			=> "section_{$section}",
			'settings'			=> "txt_{$id}",
			'type'				=> 'text',
		));
	}

	/**
	 * Añade un control de enlaces a una sección.
	 * 
	 * @param string $id
	 * @param string $default
	 * @param string $label
	 * @param string $section
	 */
	private function add_url_control( $id, $default, $label, $section ) {
		$this->manager->add_setting("url_{$id}", array(
			'default'			=> $default,
			'sanitize_callback' => 'esc_url_raw',
		));
		$this->manager->add_control("url_{$id}_control", array(
			'label'				=> __($label, $this->domain),
			'section'			=> "section_{$section}",
			'settings'			=> "url_{$id}",
			'type'				=> 'url',
		));
	}

	/**
	 * Añade un control de selección a una sección.
	 * 
	 * @param string $id
	 * @param string $default
	 * @param string $label
	 * @param string $section
	 * @param array<string> $choices
	 */
	private function add_select_control( $id, $default, $label, $section, $options ) {
		$choices = array();
		foreach( $options as $key => $value ) {
			$choices[$key] = __($value, $this->domain);
		}
		$this->manager->add_setting("sl_{$id}", array(
			'default' 		=> $default,
			'transport' 	=> 'refresh',
		));
		$this->manager->add_control("sl_{$id}_control", array(
			'label' 		=> __($label, $this->domain),
			'section' 		=> "section_{$section}",
			'settings' 		=> "sl_{$id}",
			'type'     		=> 'select',
			'choices'  		=> $choices,
		));
	}

	/**
	 * Obtiene diferentes elecciones para el control de selección.
	 * 
	 * @param string $option
	 * @return array
	 */
	private function get_choice( $option ) {
		switch( $option ) {
			case 'rounded':
				return array(
					'0' 		=> 'Ninguna',
					'0.25rem'	=> '1',
					'0.375rem' 	=> '2',
					'0.5rem' 	=> '3',
					'1rem' 		=> '4',
					'2rem' 		=> '5',
				);
				break;
			case 'shadow':
				return array(
					'none' 										=> 'Ninguna',
					'0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)'	=> 'Pequeña',
					'0 0.5rem 1rem rgba(0, 0, 0, 0.15)' 		=> 'Mediana',
					'0 1rem 3rem rgba(0, 0, 0, 0.175)' 			=> 'Grande',
				);
				break;
			case 'gutter':
				return array(
					'0' 		=> 'Ninguna',
					'0.25rem'	=> '1',
					'0.5rem' 	=> '2',
					'1rem' 		=> '3',
					'1.5rem' 	=> '4',
					'3rem' 		=> '5',
				);
				break;
			case 'weight':
				return array(
					'bolder'	=> 'Extra negrita',
					'700'		=> 'Negrita',
					'600'		=> 'Semi negrita',
					'500'		=> 'Medio',
					'400'		=> 'Normal',
					'300' 		=> 'Ligera',
					'lighter' 	=> 'Extra ligera',
				);
				break;
			default:
				return array();
				break;
		}
	}

	/**
	 * Añade un control de imagen a una sección.
	 * 
	 * @param string $id
	 * @param string $default
	 * @param string $label
	 * @param string $section
	 */
	private function add_image_control( $id, $default, $label, $section ) {
		$this->manager->add_setting("img_{$id}", array(
			'default'		=> $default,
			'transport'		=> 'refresh',
		));
		$this->manager->add_control(new WP_Customize_Image_Control($this->manager, "img_{$id}_control", array(
				'label'		=> __($label, 'supergiros'),
				'section'	=> "section_{$section}",
				'settings'	=> "img_{$id}",
			)
		));
	}

	/**
	 * Añade un control de color a una sección.
	 * 
	 * @param string $id
	 * @param string $default
	 * @param string $label
	 * @param string $section
	 */
	private function add_color_control( $id, $default, $label, $section ) {
		$this->manager->add_setting("color_{$id}", array(
			'default'			=> $default,
			'sanitize_callback'	=> 'sanitize_hex_color',
		));
		$this->manager->add_control(new WP_Customize_Color_Control($this->manager, "color_{$id}_control", array(
			'label'				=> __($label, $this->domain),
			'section'			=> "section_{$section}",
			'settings'			=> "color_{$id}",
		)));
	}

	/**
	 * Crea sección para personalizar colores y algunos ajustes de apariencia de la intranet.
	 */
	public function stylization() {
		$panel 				= 'stylization';
		$section_colors 	= 'colors';
		$section_appearance = 'appearance';
		$this->add_panel($panel, 'Estilización', 'Modificar algunos aspectos de la apariencia del sitio');
		// Colores
		$this->add_section($section_colors, 'Colores', $panel);
		$this->add_color_control('primary', 		'#2f358b', 'Principal', 			$section_colors);
		$this->add_color_control('secondary', 		'#ffd412', 'Secundario', 			$section_colors);
		$this->add_color_control('body', 			'#ffffff', 'Cuerpo', 				$section_colors);
		$this->add_color_control('body_secondary', 	'#dfeaff', 'Cuerpo secundario', 	$section_colors);
		$this->add_color_control('body_tertiary', 	'#eef4ff', 'Cuerpo terciario', 		$section_colors);
		$this->add_color_control('title', 			'#000000', 'Títulos', 				$section_colors);
		$this->add_color_control('paragraph', 		'#212529', 'Párrafos', 				$section_colors);
		// Apariencia
		$this->add_section($section_appearance, 'Apariencia', $panel);
		$this->add_select_control('appearance_rounded', '0.5rem', 	'Redondez:', 	$section_appearance, $this->get_choice('rounded'));
		$this->add_select_control('appearance_shadow', 	'0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)', 	'Sombra:', 		$section_appearance, $this->get_choice('shadow'));
		$this->add_select_control('appearance_gutter', 	'1.5rem', 	'Canal:', 		$section_appearance, $this->get_choice('gutter'));
		$this->add_select_control('appearance_gap', 	'1.5rem', 	'Brecha:', 		$section_appearance, $this->get_choice('gutter'));
	}

	/**
	 * Configura los enlaces de las redes sociales.
	 */
	public function social_media() {
		$section_social_media = 'social_media';
		$this->add_section($section_social_media, 'Redes Sociales', '');
		$this->add_url_control('facebook', 	'', 'Facebook:', 	$section_social_media);
		$this->add_url_control('instagram', '', 'Instagram:', 	$section_social_media);
		$this->add_url_control('youtube', 	'', 'YouTube:', 	$section_social_media);
		$this->add_url_control('twitter', 	'', 'Twitter (x):', $section_social_media);
	}

	/**
	 * Configura información del pie de página.
	 */
	public function footer() {
		$panel 						= 'footer';
		$section_supergiros_info 	= 'supergiros_info';
		$section_mesa_de_ayuda 		= 'mesa_de_ayuda';
		$section_sic_info 			= 'sic_info';
		$this->add_panel($panel, 'Pie de página', 'Modificar datos encontrados en el pie de página');
		// Información de SuperGIROS
		$this->add_section($section_supergiros_info, 'SuperGIROS', $panel);
		$this->add_text_control('supergiros_address', 	'', 'Dirección:', 	$section_supergiros_info);
		$this->add_text_control('supergiros_tel', 		'', 'Teléfono:', 	$section_supergiros_info);
		$this->add_text_control('supergiros_mail', 		'', 'Email:', 		$section_supergiros_info);
		// Mesa de Ayuda
		$this->add_section($section_mesa_de_ayuda, 'Mesa de Ayuda', $panel);
		$this->add_text_control('mesa_de_ayuda_tel', 	'', 'Teléfono:', 	$section_mesa_de_ayuda);
		$this->add_text_control('mesa_de_ayuda_wsp', 	'', 'WhatsApp:', 	$section_mesa_de_ayuda);
		// Información del SIC
		$this->add_section($section_sic_info, 'Superintendencia de Industria y Comercio', $panel);
		$this->add_text_control('sic_address', 	'', 'Dirección:', 	$section_sic_info);
		$this->add_text_control('sic_tel', 		'', 'Teléfono:', 	$section_sic_info);
		$this->add_text_control('sic_mail', 	'', 'Email:', 		$section_sic_info);
	}

	/**
	 * Configura los tamaños, margenes y pesos de las fuentes de la intranet.
	 */
	public function fonts() {
		$panel 				= 'fonts';
		$section_h1 		= 'h1';
		$section_h2 		= 'h2';
		$section_h3 		= 'h3';
		$section_h4 		= 'h4';
		$section_h5 		= 'h5';
		$section_h6 		= 'h6';
		$section_paragraph 	= 'paragraph';
		$section_small 		= 'small';
		$this->add_panel($panel, 'Fuentes', 'Modificar las diferentes fuentes de la Intranet');
		// H1
		$this->add_section($section_h1, 'H1', $panel);
		$this->add_text_control('fs_h1', 	'calc(1.375rem + 1.5vw)', 	'Tamaño:', 				$section_h1);
		$this->add_text_control('mb_h1', 	'1rem', 					'Margen inferior:', 	$section_h1);
		$this->add_select_control('fw_h1', 	'700', 						'Peso:', 				$section_h1, $this->get_choice('weight'));
		// H2
		$this->add_section($section_h2, 'H2', $panel);
		$this->add_text_control('fs_h2', 	'calc(1.325rem + 0.9vw)', 	'Tamaño:', 				$section_h2);
		$this->add_text_control('mb_h2', 	'1rem', 					'Margen inferior:', 	$section_h2);
		$this->add_select_control('fw_h2', 	'700', 						'Peso:', 				$section_h2, $this->get_choice('weight'));
		// H3
		$this->add_section($section_h3, 'H3', $panel);
		$this->add_text_control('fs_h3', 	'calc(1.3rem + 0.6vw)', 	'Tamaño:', 				$section_h3);
		$this->add_text_control('mb_h3', 	'1rem', 					'Margen inferior:', 	$section_h3);
		$this->add_select_control('fw_h3', 	'600', 						'Peso:', 				$section_h3, $this->get_choice('weight'));
		// H4
		$this->add_section($section_h4, 'H4', $panel);
		$this->add_text_control('fs_h4', 	'calc(1.275rem + 0.3vw)', 	'Tamaño:', 				$section_h4);
		$this->add_text_control('mb_h4', 	'1rem', 					'Margen inferior:', 	$section_h4);
		$this->add_select_control('fw_h4', 	'600', 						'Peso:', 				$section_h4, $this->get_choice('weight'));
		// H5
		$this->add_section($section_h5, 'H5', $panel);
		$this->add_text_control('fs_h5', 	'1.25rem', 					'Tamaño:', 				$section_h5);
		$this->add_text_control('mb_h5', 	'1rem', 					'Margen inferior:', 	$section_h5);
		$this->add_select_control('fw_h5', 	'500', 						'Peso:', 				$section_h5, $this->get_choice('weight'));
		// H6
		$this->add_section($section_h6, 'H6', $panel);
		$this->add_text_control('fs_h6', 	'1rem', 					'Tamaño:', 				$section_h6);
		$this->add_text_control('mb_h6', 	'1rem', 					'Margen inferior:', 	$section_h6);
		$this->add_select_control('fw_h6', 	'500', 						'Peso:', 				$section_h6, $this->get_choice('weight'));
		// Párrafos
		$this->add_section($section_paragraph, 'Párrafos', $panel);
		$this->add_text_control('fs_paragraph', 	'1rem', 			'Tamaño:', 				$section_paragraph);
		$this->add_text_control('mb_paragraph', 	'1rem', 			'Margen inferior:', 	$section_paragraph);
		$this->add_select_control('fw_paragraph', 	'400', 				'Peso:', 				$section_paragraph, $this->get_choice('weight'));
		// Pequeños
		$this->add_section($section_small, 'Pequeños', $panel);
		$this->add_text_control('fs_small', 		'1rem', 			'Tamaño:', 				$section_small);
		$this->add_text_control('mb_small', 		'1rem', 			'Margen inferior:', 	$section_small);
		$this->add_select_control('fw_small', 		'400', 				'Peso:', 				$section_small, $this->get_choice('weight'));
	}

	/**
	 * Crea los ajustes para los 5 banners de la página de inicio.
	 */
	public function carousel() {
		$panel 				= 'carousel';
		$section_banner_1 	= 'banner_1';
		$section_banner_2 	= 'banner_2';
		$section_banner_3 	= 'banner_3';
		$section_banner_4 	= 'banner_4';
		$section_banner_5 	= 'banner_5';
		$this->add_panel($panel, 'Carrusel de Inicio', 'Este es el carrusel que se encuentra en la pantalla principal, el tamaño optimo de las imagenes es una resolución de 1903x786');
		// Banner #1
		$this->add_section($section_banner_1, 'Banner #1', $panel);
		$this->add_image_control('banner_1', '', 	'Imagen (1903x786):', 	$section_banner_1);
		$this->add_url_control('banner_1', '', 		'Enlace:', 				$section_banner_1);
		// Banner #2
		$this->add_section($section_banner_2, 'Banner #2', $panel);
		$this->add_image_control('banner_2', '', 	'Imagen (1903x786):', 	$section_banner_2);
		$this->add_url_control('banner_2', '', 		'Enlace:', 				$section_banner_2);
		// Banner #1
		$this->add_section($section_banner_3, 'Banner #3', $panel);
		$this->add_image_control('banner_3', '', 	'Imagen (1903x786):', 	$section_banner_3);
		$this->add_url_control('banner_3', '', 		'Enlace:', 				$section_banner_3);
		// Banner #1
		$this->add_section($section_banner_4, 'Banner #4', $panel);
		$this->add_image_control('banner_4', '', 	'Imagen (1903x786):', 	$section_banner_4);
		$this->add_url_control('banner_4', '', 		'Enlace:', 				$section_banner_4);
		// Banner #1
		$this->add_section($section_banner_5, 'Banner #5', $panel);
		$this->add_image_control('banner_5', '', 	'Imagen (1903x786):', 	$section_banner_5);
		$this->add_url_control('banner_5', '', 		'Enlace:', 				$section_banner_5);
	}

	/**
	 * Permite configurar la apariencia de los botónes.
	 */
	public function buttons() {
		$panel 					= 'buttons';
		$section_globals 		= 'globals';
		$section_btn_primary 	= 'btn_primary';
		$section_btn_secondary 	= 'btn_secondary';
		$this->add_panel($panel, 'Botones', 'Modificar algunos aspectos de la apariencia del sitio');
		// Globals
		$this->add_section($section_globals, 'Globales', $panel);
		$this->add_text_control('btn_fs', 			'1rem', 	'Tamaño de fuente:', 			$section_globals);
		$this->add_select_control('btn_fw', 		'400', 		'Peso:', 						$section_globals, $this->get_choice('weight'));
		$this->add_select_control('btn_rounded', 	'0.5rem', 	'Redondez:', 					$section_globals, $this->get_choice('rounded'));
		$this->add_text_control('btn_padding_x', 	'0.375rem', 'Espaciado horizontal (x):', 	$section_globals);
		$this->add_text_control('btn_padding_y', 	'0.375rem', 'Espaciado vertical (y):', 		$section_globals);
		// Botón primario
		$this->add_section($section_btn_primary, 'Botón primario', $panel);
		$this->add_color_control('btn_primary_text', 			'#FFFFFF', 'Texto:', 			$section_btn_primary);
		$this->add_color_control('btn_primary_bg', 				'#2F358B', 'Fondo:', 			$section_btn_primary);
		$this->add_color_control('btn_primary_border', 			'#2F358B', 'Borde:', 			$section_btn_primary);
		$this->add_color_control('btn_hover_primary_text', 		'#FFFFFF', 'Texto (hover):', 	$section_btn_primary);
		$this->add_color_control('btn_hover_primary_bg', 		'#323562', 'Fondo (hover):', 	$section_btn_primary);
		$this->add_color_control('btn_hover_primary_border', 	'#323562', 'Borde (hover):', 	$section_btn_primary);
		$this->add_color_control('btn_active_primary_text', 	'#FFFFFF', 'Texto (active):', 	$section_btn_primary);
		$this->add_color_control('btn_active_primary_bg', 		'#252637', 'Fondo (active):', 	$section_btn_primary);
		$this->add_color_control('btn_active_primary_border', 	'#252637', 'Borde (active):', 	$section_btn_primary);
		// Botón secundario
		$this->add_section($section_btn_secondary, 'Botón secundario', $panel);
		$this->add_color_control('btn_secondary_text', 			'#FFFFFF', 'Texto:', 			$section_btn_secondary);
		$this->add_color_control('btn_secondary_bg', 			'#FFD412', 'Fondo:', 			$section_btn_secondary);
		$this->add_color_control('btn_secondary_border', 		'#FFD412', 'Borde:', 			$section_btn_secondary);
		$this->add_color_control('btn_hover_secondary_text', 	'#FFFFFF', 'Texto (hover):', 	$section_btn_secondary);
		$this->add_color_control('btn_hover_secondary_bg', 		'#D5B732', 'Fondo (hover):', 	$section_btn_secondary);
		$this->add_color_control('btn_hover_secondary_border', 	'#D5B732', 'Borde (hover):', 	$section_btn_secondary);
		$this->add_color_control('btn_active_secondary_text', 	'#FFFFFF', 'Texto (active):', 	$section_btn_secondary);
		$this->add_color_control('btn_active_secondary_bg', 	'#AA9745', 'Fondo (active):', 	$section_btn_secondary);
		$this->add_color_control('btn_active_secondary_border', '#AA9745', 'Borde (active):', 	$section_btn_secondary);
	}

	/**
	 * Permite configurar los anuncios de la página.
	 */
	public function ads() {
		$panel 					= 'ads';
		$section_noticias_ads 	= 'noticias_ads';
		$section_documentos_ads = 'documentos_ads';
		$this->add_panel($panel, 'Anuncios', 'Pequeños anuncios que se encuentran a lo largo de la página');
		// Anuncio de noticias
		$this->add_section($section_noticias_ads, 'Noticias', $panel);
		$this->add_image_control('noticias_ads', '', 	'Imagen:', 	$section_noticias_ads);
		$this->add_url_control('noticias_ads', '', 		'Enlace:', 	$section_noticias_ads);
		// Anuncio de noticias
		$this->add_section($section_documentos_ads, 'Documentos', $panel);
		$this->add_image_control('documentos_ads', '', 	'Imagen:', 	$section_documentos_ads);
		$this->add_url_control('documentos_ads', '', 	'Enlace:', 	$section_documentos_ads);
	}

}
