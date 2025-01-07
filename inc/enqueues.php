<?php
function supergiros_head_style() {
    $color_primary = get_theme_mod('color_primary', '#2f358b');
    $color_secondary = get_theme_mod('color_secondary', '#ffd412');
    $color_body = get_theme_mod('color_body', '#ffffff');
    $color_body_secondary = get_theme_mod('color_body_secondary', '#dfeaff');
    $color_body_tertiary = get_theme_mod('color_body_tertiary', '#eef4ff');
    $color_title = get_theme_mod('color_title', '#000000');
    $color_paragraph = get_theme_mod('color_paragraph', '#212529');

    echo "<style>
        :root {
            --sg-primary: $color_primary;
            --sg-secondary: $color_secondary;
            --sg-body: $color_body;
            --sg-body-secondary: $color_body_secondary;
            --sg-body-tertiary: $color_body_tertiary;
            --sg-title: $color_title;
            --sg-paragraph: $color_paragraph;
        }
    </style>";
}
function supergiros_scripts() {
    wp_enqueue_style(
        'bootstrap-styles',
        get_template_directory_uri() . '/assets/vendor/bootstrap/bootstrap.min.css',
        array(),
        '5.3.3',
        'all',
    );
    wp_enqueue_script(
        'bootstrap-bundle',
        get_template_directory_uri() . '/assets/vendor/bootstrap/bootstrap.bundle.min.js',
        array(),
        '5.3.3',
        true,
    );
    wp_enqueue_style(
        'bootstrap-icons-styles',
        get_template_directory_uri() . '/assets/vendor/bootstrap-icons/font/bootstrap-icons.min.css',
        array(),
        '1.13.3',
        'all',
    );
    wp_enqueue_style(
        'supergiros-styles',
        get_stylesheet_uri(),
    );
    wp_enqueue_script(
        'supergiros-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        null,
        true,
    );
    if (is_home()) {
        wp_enqueue_script(
            'supergiros-main-fetch',
            get_template_directory_uri() . '/assets/js/main-fetch.js',
            array(),
            null,
            true
        );
        wp_enqueue_script(
            'supergiros-scroll-animation',
            get_template_directory_uri() . '/assets/js/animacionScroll.js',
            array(),
            null,
            true
        );
        wp_enqueue_script(
            'supergiros-fetch-last-news',
            get_template_directory_uri() . '/assets/js/fetch-last-news.js',
            array(),
            null,
            true
        );
        wp_enqueue_script(
            'supergiros-fetch-lottery-results',
            get_template_directory_uri() . '/assets/js/fetch-lottery-results.js',
            array(),
            null,
            true
        );
        wp_enqueue_script(
            'supergiros-chance-simulator',
            get_template_directory_uri() . '/assets/js/chance-simulator.js',
            array(),
            null,
            true
        );
    }
    if (is_page( 'ingresar' )) {
        wp_enqueue_script(
            'supergiros-show-pass',
            get_template_directory_uri() . '/assets/js/utils/showPass.js',
            array(),
            null,
            true
        );
    }
    if (is_archive()) {
        wp_enqueue_script(
            'supergiros-main-fetch',
            get_template_directory_uri() . '/assets/js/main-fetch.js',
            array(),
            null,
            true
        );
        wp_enqueue_script(
            'supergiros-main-posts',
            get_template_directory_uri() . '/assets/js/main-posts.js',
            array(),
            null,
            true,
        );
        $post_type = get_post_type();
        if (empty($post_type)) {
            $queried_object = get_queried_object();
            $taxonomy_object = get_taxonomy($queried_object->taxonomy);
            $post_type = $taxonomy_object->object_type[0];
        }
        switch ($post_type) {
            case 'portafolio':
                wp_enqueue_script(
                    'supergiros-loop-portafolio',
                    get_template_directory_uri() . '/assets/js/loop-portafolio.js',
                    array(),
                    null,
                    true
                );
                break;
            case 'noticias':
                wp_enqueue_script(
                    'supergiros-loop-noticias',
                    get_template_directory_uri() . '/assets/js/loop-noticias.js',
                    array(),
                    null,
                    true
                );
                break;
            case 'planes_de_premios':
                wp_enqueue_script(
                    'supergiros-loop-planes_de_premios',
                    get_template_directory_uri() . '/assets/js/loop-planes_de_premios.js',
                    array(),
                    null,
                    true
                );
                break;
            case 'resultados_y_secos':
                wp_enqueue_script(
                    'supergiros-loop-resultados_y_secos',
                    get_template_directory_uri() . '/assets/js/loop-resultados_y_secos.js',
                    array(),
                    null,
                    true
                );
                break;
            case 'documentos':
                wp_enqueue_script(
                    'supergiros-loop-documentos',
                    get_template_directory_uri() . '/assets/js/loop-documentos.js',
                    array(),
                    null,
                    true
                );
                break;
            case 'post':
                wp_enqueue_script(
                    'supergiros-loop-post',
                    get_template_directory_uri() . '/assets/js/loop-post.js',
                    array(),
                    null,
                    true
                );
                break;
        }
    }
}
function supergiros_admin_scripts() {
    wp_enqueue_media();
    if (isset($_GET['page']) && $_GET['page'] === 'banners') {
        wp_enqueue_script('jquery');
        wp_enqueue_script(
            'supergiros-carousel-config',
            get_template_directory_uri() . '/assets/js/utils/carouselConfig.js',
            array('jquery'),
            null,
            true
        );
    }
}
function supergiros_editor_scripts() {
    wp_enqueue_style(
        'bootstrap-editor-styles',
        get_template_directory_uri() . '/assets/vendor/bootstrap/bootstrap.min.css',
        array(),
        '5.3.3',
        'all'
    );
    wp_enqueue_style(
        'supergiros-editor-styles',
        get_stylesheet_uri()
    );
}

add_action('wp_head', 'supergiros_head_style');
add_action('wp_enqueue_scripts', 'supergiros_scripts');
add_action('admin_enqueue_scripts', 'supergiros_admin_scripts');
add_action('enqueue_block_editor_assets', 'supergiros_editor_scripts');
