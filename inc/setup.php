<?php
function supergiros_theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    register_nav_menus(
        array(
            'nav-public' => 'Cabecera publica',
            'nav-private' => 'Cabecera privada',
            'nav-footer' => 'Pie de página',
        )
    );
}
add_action('after_setup_theme', 'supergiros_theme_setup');