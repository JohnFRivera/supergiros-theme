<?php
//* CABECERA
add_filter( 'show_admin_bar', '__return_false' );


require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueues.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/shortcodes.php';
require_once get_template_directory() . '/inc/helpers.php';