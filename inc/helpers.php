<?php
function sgnv_get_image_url( $image_name ) {
    return get_template_directory_uri() . '/assets/images/' . $image_name;
}

function sgnv_get_component( $component_name ) {
    return get_template_directory() . '/template-parts/components/' . $component_name;
}

function sgnv_get_post_type() {
    $post_type = get_post_type();
    if (empty($post_type)) {
        // Si se está en una taxonomía, se busca el post type de esa taxonomía
        $queried_object = get_queried_object();
        $taxonomy_object = get_taxonomy($queried_object->taxonomy);
        $post_type = $taxonomy_object->object_type[0];
    }
    return $post_type;
}
function sgnv_get_taxonomy() {
    $taxonomy = '';
    if ( is_archive() ) {
        $post_type = sgnv_get_post_type();
        $taxonomy = get_object_taxonomies( $post_type )[0];
    }
    if ( is_tax() ) {
        $queried_object = get_queried_object();
        $taxonomy = $queried_object->taxonomy;
    }
    return $taxonomy;
}
function sgnv_get_term() {
    $term = '';
    if (is_tax()) {
        $queried_object = get_queried_object();
        $term = $queried_object->slug;
    }
    return $term;
}