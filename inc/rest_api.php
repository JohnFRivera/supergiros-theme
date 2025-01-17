<?php
add_action( 'rest_api_init', 'supergiros_theme_rest_api' );

function supergiros_theme_rest_api() {
    register_rest_route('supergiros/v1', '/resultados-sorteos/', array(
        'methods' => 'POST',
        'callback' => 'supergiros_post_resultados_sorteos',
        'permission_callback' => '__return_true',
    ));
    register_rest_route( 'supergiros/v1', 'posts', array(
        'methods'               => 'POST',
        'callback'              => 'supergiros_theme_post_posts',
        'permission_callback'   => '__return_true',
    ));
    register_rest_route( 'supergiros/v1', 'portafolio', array(
        'methods'               => 'POST',
        'callback'              => 'supergiros_theme_post_portafolio',
        'permission_callback'   => '__return_true',
    ));
    register_rest_route( 'supergiros/v1', 'noticias-recientes', array(
        'methods'               => 'GET',
        'callback'              => 'supergiros_theme_get_noticias_recientes',
    ));
    register_rest_route( 'supergiros/v1', 'noticias', array(
        'methods'               => 'POST',
        'callback'              => 'supergiros_theme_post_noticias',
        'permission_callback'   => '__return_true',
    ));
    register_rest_route( 'supergiros/v1', 'planes-de-premios', array(
        'methods'               => 'POST',
        'callback'              => 'supergiros_theme_post_planes_de_premios',
        'permission_callback'   => '__return_true',
    ));
    register_rest_route( 'supergiros/v1', 'resultados-y-secos', array(
        'methods'               => 'POST',
        'callback'              => 'supergiros_theme_post_resultados_y_secos',
        'permission_callback'   => '__return_true',
    ));
    register_rest_route( 'supergiros/v1', 'documentos', array(
        'methods'               => 'POST',
        'callback'              => 'supergiros_theme_post_documentos',
        'permission_callback'   => '__return_true',
    ));
}

//* SORTEOS
function supergiros_post_resultados_sorteos( WP_REST_Request $request ) {
    $fecha = $request->get_param('fecha');

    $url = 'https://portal.supergirosnortedelvalle.com/api/resultados'; // URL de la API externa
    if ($fecha) {
        $url .= '?fecha='.$fecha;
    }
    $response = wp_remote_get($url);
    if (is_wp_error($response)) {
        return new WP_Error('api_error', 'No se pudo obtener datos de la API externa', array('status' => 500));
    }
    $body = wp_remote_retrieve_body($response);

    return json_decode($body, true);
}

//* POSTS
function supergiros_theme_post_posts( WP_REST_Request $request ) {
    $term = $request->get_param( 'term' );
    $search = $request->get_param( 'search' );
    $orderby = $request->get_param( 'orderby' );
    $order = $request->get_param( 'order' );
    $paged = $request->get_param( 'paged' );

    $args = array(
        'post_type'         => 'post',
        'orderby'           => isset($orderby) ? $orderby : 'date',
        'order'             => isset($order) ? $order : 'DESC',
        'posts_per_page'    => 10,
        'paged'             => isset( $paged ) ? $paged : 1,
    );
    if( !empty($search) ) $args['s'] = $search;
    if ( isset( $term ) ) {
        $args['category_name'] = $term;
    }
    $query = new WP_Query( $args );
    $response = array();
    if( $query->have_posts() ) {
        while( $query->have_posts() ) {
            $query->the_post();
            $thumbnail_url = get_the_post_thumbnail_url();
            $response[] = array(
                'id'        => get_the_ID(),
                'thumbnail' => !empty( $thumbnail_url ) ? $thumbnail_url : sgnv_get_image_url( 'thumbnail-noticias.webp' ),
                'title'     => get_the_title(),
                'excerpt'   => get_the_excerpt(),
                'date'      => get_the_date( 'j \d\e F, Y' ),
                'link'      => get_the_permalink(),
            );
        }
        wp_reset_postdata();
    } else {
        $response['message'] = 'No se encontraron publicaciones';
    }

    return new WP_REST_Response( $response, 200 );
}

//* PORTAFOLIO
function supergiros_theme_post_portafolio( WP_REST_Request $request ) {
    $paged = $request->get_param( 'paged' );

    $args = array(
        'post_type'         => 'portafolio',
        'orderby'           => 'date',
        'order'             => 'DESC',
        'posts_per_page'    => 8,
        'paged'             => isset($paged) ? $paged : 1,
    );
    $query = new WP_Query( $args );
    $response = array();
    if( $query->have_posts() ) {
        while( $query->have_posts() ) {
            $query->the_post();
            $thumbnail_url = get_the_post_thumbnail_url();
            $response[] = array(
                'id'        => get_the_ID(),
                'logo'      => !empty( $thumbnail_url ) ? $thumbnail_url : sgnv_get_image_url( 'thumbnail-logo.png' ),
                'title'     => get_the_title(),
                'excerpt'   => get_the_excerpt(),
                'link'      => get_the_permalink(),
            );
        }
        wp_reset_postdata();
    } else {
        $response['message'] = 'No se encontraron elementos en el portafolio';
    }

    return new WP_REST_Response( $response, 200 );
}

//* NOTICIAS
function supergiros_theme_get_noticias_recientes() {
    $args = array(
        'post_type'         => 'noticias',
        'orderby'           => 'date',
        'order'             => 'DESC',
        'posts_per_page'    => 2,
    );
    $query = new WP_Query( $args );
    $response = array();
    if( $query->have_posts() ) {
        while( $query->have_posts() ) {
            $query->the_post();
            $thumbnail_url = get_the_post_thumbnail_url();
            $response[] = array(
                'id'        => get_the_ID(),
                'thumbnail' => !empty( $thumbnail_url ) ? $thumbnail_url : sgnv_get_image_url( 'thumbnail-noticias.webp' ),
                'title'     => get_the_title(),
                'date'      => get_the_date( 'j \d\e F, Y' ),
                'link'      => get_the_permalink(),
            );
        }
        wp_reset_postdata();
    } else {
        $response['message'] = 'No se encontraron noticias recientes';
    }

    return new WP_REST_Response( $response, 200 );
}
function supergiros_theme_post_noticias( WP_REST_Request $request ) {
    $term = $request->get_param( 'term' );
    $search = $request->get_param( 'search' );
    $orderby = $request->get_param( 'orderby' );
    $order = $request->get_param( 'order' );
    $paged = $request->get_param( 'paged' );

    $args = array(
        'post_type'         => 'noticias',
        'orderby'           => isset($orderby) ? $orderby : 'date',
        'order'             => isset($order) ? $order : 'DESC',
        'posts_per_page'    => 12,
        'paged'             => isset($paged) ? $paged : 1,
    );
    if( !empty($search) ) $args['s'] = $search;
    if( !empty($term) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy'  => 'tipos_noticias',
                'terms'     => $term,
                'field'     => 'slug',
                'operators' => 'IN',
            ),
        );
    }
    $query = new WP_Query( $args );
    $response = array();
    if( $query->have_posts() ) {
        while( $query->have_posts() ) {
            $query->the_post();
            $thumbnail_url = get_the_post_thumbnail_url();
            $response[] = array(
                'id'        => get_the_ID(),
                'thumbnail' => !empty( $thumbnail_url ) ? $thumbnail_url : sgnv_get_image_url( 'thumbnail-noticias.webp' ),
                'title'     => get_the_title(),
                'date'      => get_the_date( 'j \d\e F, Y' ),
                'link'      => get_the_permalink(),
            );
        }
        wp_reset_postdata();
    } else {
        $response['message'] = 'No se encontraron noticias';
    }

    return new WP_REST_Response( $response, 200 );
}

//* LOTERÍAS
function supergiros_theme_post_planes_de_premios( WP_REST_Request $request ) {
    $paged = $request->get_param( 'paged' );

    $args = array(
        'post_type'         => 'planes-de-premios',
        'orderby'           => 'date',
        'order'             => 'DESC',
        'posts_per_page'    => 10,
        'paged'             => isset($paged) ? $paged : 1,
    );
    $query = new WP_Query( $args );
    $response = array();
    if( $query->have_posts() ) {
        while( $query->have_posts() ) {
            $query->the_post();
            $post_term = get_the_terms( get_the_ID(), 'loterias' )[0];
            $response[] = array(
                'id'        => get_the_ID(),
                'logo'      => get_term_meta( $post_term->term_id, '_loteria_logotipo', true ),
                'title'     => $post_term->name,
                'date'      => get_the_date( 'j \d\e F, Y' ),
                'link'      => get_the_permalink(),
            );
        }
        wp_reset_postdata();
    } else {
        $response['message'] = 'No se encontraron planes de premios';
    }

    return new WP_REST_Response( $response, 200 );
}
function supergiros_theme_post_resultados_y_secos( WP_REST_Request $request ) {
    $term = $request->get_param( 'term' );
    $year = $request->get_param( 'year' );
    $month = $request->get_param( 'month' );
    $day = $request->get_param( 'day' );
    $paged = $request->get_param( 'paged' );

    $args = array(
        'post_type'         => 'resultados-y-secos',
        'orderby'           => 'date',
        'order'             => 'DESC',
        'posts_per_page'    => 10,
        'paged'             => isset($paged) ? $paged : 1,
    );
    if( !empty($year) ) $args['year'] = $year;
    if( !empty($month) ) $args['month'] = $month;
    if( !empty($day) ) $args['day'] = $day;
    if( !empty($term) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy'  => 'loterias',
                'terms'     => $term,
                'field'     => 'slug',
                'operators' => 'IN',
            ),
        );
    }
    $query = new WP_Query( $args );
    $response = array();
    if( $query->have_posts() ) {
        while( $query->have_posts() ) {
            $query->the_post();
            $ID = get_the_ID();
            $post_term = get_the_terms( $ID, 'loterias' )[0];
            $response['year'][] = get_the_date( 'Y' );
            $response['month'][] = array(
                'text'  => ucfirst(get_the_date( 'F' )),
                'value' => get_the_date( 'm' ),
            );
            $response['day'][] = get_the_date( 'd' );
            $response['results'][] = array(
                'id'        => $ID,
                'logo'      => get_term_meta( $post_term->term_id, '_loteria_logotipo', true ),
                'title'     => $post_term->name,
                'date'      => get_the_date( 'j \d\e F, Y' ),
                'link'      => get_the_permalink(),
            );
        }
        wp_reset_postdata();
    } else {
        $response['message'] = 'No se encontraron resultados y secos';
    }

    return new WP_REST_Response( $response, 200 );
}

//* DOCUMENTOS
function supergiros_theme_post_documentos( WP_REST_Request $request ) {
    $term = $request->get_param( 'term' );
    $search = $request->get_param( 'search' );
    $orderby = $request->get_param( 'orderby' );
    $order = $request->get_param( 'order' );
    $paged = $request->get_param( 'paged' );

    $args = array(
        'post_type'         => 'documentos',
        'orderby'           => isset($orderby) ? $orderby : 'date',
        'order'             => isset($order) ? $order : 'DESC',
        'posts_per_page'    => 12,
        'paged'             => isset($paged) ? $paged : 1,
    );
    if( !empty($search) ) $args['s'] = $search;
    if( !empty($term) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy'  => 'clasificaciones_documentos',
                'terms'     => $term,
                'field'     => 'slug',
                'operators' => 'IN',
            ),
        );
    }
    $query = new WP_Query( $args );
    $response = array();
    if( $query->have_posts() ) {
        while( $query->have_posts() ) {
            $query->the_post();
            $ID = get_the_ID();
            $thumbnail_url = get_the_post_thumbnail_url();
            $response[] = array(
                'id'        => $ID,
                'thumbnail' => !empty( $thumbnail_url ) ? $thumbnail_url : sgnv_get_image_url( 'thumbnail-documentos.webp' ),
                'title'     => get_the_title(),
                'date'      => get_the_date( 'j \d\e F, Y' ),
                'link'      => get_post_meta( $ID, '_documento_url', true ),
            );
        }
        wp_reset_postdata();
    } else {
        $response['message'] = 'No se encontraron documentos';
    }

    return new WP_REST_Response( $response, 200 );
}
