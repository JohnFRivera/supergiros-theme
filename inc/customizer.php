<?php
function supergiros_customize_register($wp_customize) {
    // COLORS
    $wp_customize->add_section('section_colors', array(
        'title'    => __('Colores', 'supergiros'),
        'priority' => 30,
    ));
    $wp_customize->add_setting('color_primary', array(
        'default' => '#2f358b',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_primary', array(
        'label' => __('Principal', 'supergiros'),
        'section' => 'section_colors',
        'settings' => 'color_primary',
    )));
    $wp_customize->add_setting('color_secondary', array(
        'default' => '#ffd412',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_secondary', array(
        'label' => __('Secundario', 'supergiros'),
        'section' => 'section_colors',
        'settings' => 'color_secondary',
    )));
    $wp_customize->add_setting('color_body', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_body', array(
        'label' => __('Body', 'supergiros'),
        'section' => 'section_colors',
        'settings' => 'color_body',
    )));
    $wp_customize->add_setting('color_body_secondary', array(
        'default' => '#dfeaff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_body_secondary', array(
        'label' => __('Body Secundario', 'supergiros'),
        'section' => 'section_colors',
        'settings' => 'color_body_secondary',
    )));
    $wp_customize->add_setting('color_body_tertiary', array(
        'default' => '#eef4ff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_body_tertiary', array(
        'label' => __('Body Terciario', 'supergiros'),
        'section' => 'section_colors',
        'settings' => 'color_body_tertiary',
    )));
    $wp_customize->add_setting('color_title', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_title', array(
        'label' => __('Títulos', 'supergiros'),
        'section' => 'section_colors',
        'settings' => 'color_title',
    )));
    $wp_customize->add_setting('color_paragraph', array(
        'default' => '#212529',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_paragraph', array(
        'label' => __('Párrafos', 'supergiros'),
        'section' => 'section_colors',
        'settings' => 'color_paragraph',
    )));

    // CAROUSEL
    $wp_customize->add_section('section_carousel', array(
        'title'       => __('Carrusel de Inicio', 'supergiros'),
        'priority'    => 30,
    ));
    $wp_customize->add_setting('carousel_image_1', array(
        'default'     => '',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'carousel_image_1_control', array(
            'label'   => __('Imagen 1', 'supergiros'),
            'section' => 'section_carousel',
            'settings' => 'carousel_image_1',
        )
    ));
    $wp_customize->add_setting('carousel_image_2', array(
        'default'     => '',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'carousel_image_2_control', array(
            'label'   => __('Imagen 2', 'supergiros'),
            'section' => 'section_carousel',
            'settings' => 'carousel_image_2',
        )
    ));
    $wp_customize->add_setting('carousel_image_3', array(
        'default'     => '',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'carousel_image_3_control', array(
            'label'   => __('Imagen 3', 'supergiros'),
            'section' => 'section_carousel',
            'settings' => 'carousel_image_3',
        )
    ));
    $wp_customize->add_setting('carousel_image_4', array(
        'default'     => '',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'carousel_image_4_control', array(
            'label'   => __('Imagen 4', 'supergiros'),
            'section' => 'section_carousel',
            'settings' => 'carousel_image_4',
        )
    ));

    // ANUNCIOS
    $wp_customize->add_panel( 'panel_ads', array(
        'title' => __( 'Anuncios' ),
        'description' => 'Pequeños anuncios que se encuentran a lo largo de la página',
        'priority' => 50,
    ));
    //? Noticias
    $wp_customize->add_section( 'section_noticias_ads' , array(
        'title' => __( 'Noticias', 'supergiros' ),
        'panel' => 'panel_ads',
    ));
    $wp_customize->add_setting('noticias_ads_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'noticias_ads_image', array(
        'section' => 'section_noticias_ads',
        'settings' => 'noticias_ads_image',
        'label' => __('Imagen:', 'supergiros'),
    )));
    $wp_customize->add_setting('noticias_ads_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('noticias_ads_url', array(
        'section' => 'section_noticias_ads',
        'settings' => 'noticias_ads_url',
        'label' => __('Enlace:', 'supergiros'),
        'type' => 'url',
    ));
    //? Documentos
    $wp_customize->add_section( 'section_documentos_ads' , array(
        'title' => __( 'Documentos', 'supergiros' ),
        'panel' => 'panel_ads',
    ));
    $wp_customize->add_setting('documentos_ads_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'documentos_ads_image', array(
        'section' => 'section_documentos_ads',
        'settings' => 'documentos_ads_image',
        'label' => __('Imagen:', 'supergiros'),
    )));
    $wp_customize->add_setting('documentos_ads_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('documentos_ads_url', array(
        'section' => 'section_documentos_ads',
        'settings' => 'documentos_ads_url',
        'label' => __('Enlace:', 'supergiros'),
        'type' => 'url',
    ));

    // REDES SOCIALES
    $wp_customize->add_section('section_social_media', array(
        'title' => __('Redes Sociales', 'supergiros'),
        'priority' => 30, // Orden de aparición
    ));
    $wp_customize->add_setting('facebook_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('facebook_url', array(
        'label' => __('Facebook:', 'supergiros'),
        'section' => 'section_social_media',
        'type' => 'url',
        'settings' => 'facebook_url',
    ));
    $wp_customize->add_setting('instagram_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('instagram_url', array(
        'label' => __('Instagram:', 'supergiros'),
        'section' => 'section_social_media',
        'type' => 'url',
        'settings' => 'instagram_url',
    ));
    $wp_customize->add_setting('youtube_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('youtube_url', array(
        'label' => __('YouTube:', 'supergiros'),
        'section' => 'section_social_media',
        'type' => 'url',
        'settings' => 'youtube_url',
    ));
    $wp_customize->add_setting('twitter_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('twitter_url', array(
        'label' => __('Twitter (x):', 'supergiros'),
        'section' => 'section_social_media',
        'type' => 'url',
        'settings' => 'twitter_url',
    ));

    // PIE DE PÁGINA
    $wp_customize->add_panel( 'panel_footer', array(
        'title' => __( 'Pie de página' ),
        'description' => 'Modificar datos encontrados en el pie de página',
        'priority' => 160,
    ));
    //? Información de superGiros, primer columna del footer
    $wp_customize->add_section( 'section_supergiros_info' , array(
        'title' => __( 'SuperGIROS', 'supergiros' ),
        'panel' => 'panel_footer',
    ));
    $wp_customize->add_setting('supergiros_info_direccion', array(
        'default' => 'Carrera 5 No. 10-93 Cartago, Valle del Cauca, Colombia',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('supergiros_info_direccion', array(
        'section' => 'section_supergiros_info',
        'settings' => 'supergiros_info_direccion',
        'label' => __('Dirección:', 'supergiros'),
        'type' => 'text',
    ));
    $wp_customize->add_setting('supergiros_info_tel', array(
        'default' => 'PBX (602) 214 7100 ext 141',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('supergiros_info_tel', array(
        'section' => 'section_supergiros_info',
        'settings' => 'supergiros_info_tel',
        'label' => __('Teléfono:', 'supergiros'),
        'type' => 'text',
    ));
    $wp_customize->add_setting('supergiros_info_mail', array(
        'default' => 'info@ganesuperservicios.co',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('supergiros_info_mail', array(
        'section' => 'section_supergiros_info',
        'settings' => 'supergiros_info_mail',
        'label' => __('Email:', 'supergiros'),
        'type' => 'text',
    ));
    //? Información de Mesa de ayuda, tercer columna
    $wp_customize->add_section( 'section_mesa_de_ayuda' , array(
        'title' => __( 'Mesa de Ayuda', 'supergiros' ),
        'panel' => 'panel_footer',
    ));
    $wp_customize->add_setting('mesa_de_ayuda_tel', array(
        'default' => '318 734 704',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mesa_de_ayuda_tel', array(
        'section' => 'section_mesa_de_ayuda',
        'settings' => 'mesa_de_ayuda_tel',
        'label' => __('Teléfono:', 'supergiros'),
        'type' => 'text',
    ));
    $wp_customize->add_setting('mesa_de_ayuda_whatsapp', array(
        'default' => '+57 318 547 8633',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mesa_de_ayuda_whatsapp', array(
        'section' => 'section_mesa_de_ayuda',
        'settings' => 'mesa_de_ayuda_whatsapp',
        'label' => __('Whatsapp:', 'supergiros'),
        'type' => 'text',
    ));
    //? Información de Superintendencia de industria y comercio, ultima columna del footer
    $wp_customize->add_section( 'section_sic_info' , array(
        'title' => __( 'Superintendencia de Industria y Comercio', 'supergiros' ),
        'panel' => 'panel_footer',
    ));
    $wp_customize->add_setting('sic_info_direccion', array(
        'default' => 'Carrera 13 No. 27-00 Piso 1-2-4-6-7-10 Bogotá D.C, Colombia',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('sic_info_direccion', array(
        'section' => 'section_sic_info',
        'settings' => 'sic_info_direccion',
        'label' => __('Dirección:', 'supergiros'),
        'type' => 'text',
    ));
    $wp_customize->add_setting('sic_info_tel', array(
        'default' => 'Linea Gratuita 018000910165',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('sic_info_tel', array(
        'section' => 'section_sic_info',
        'settings' => 'sic_info_tel',
        'label' => __('Teléfono:', 'supergiros'),
        'type' => 'text',
    ));
    $wp_customize->add_setting('sic_info_mail', array(
        'default' => 'contactenos@sic.gov.co',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('sic_info_mail', array(
        'section' => 'section_sic_info',
        'settings' => 'sic_info_mail',
        'label' => __('Email:', 'supergiros'),
        'type' => 'text',
    ));
}
add_action('customize_register', 'supergiros_customize_register');