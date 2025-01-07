<?php
function supergiros_get_image_url($image_name) {
    return get_template_directory_uri() . '/assets/images/' . $image_name;
}

function supergiros_get_page_title() {
    if (is_page()) {
        return get_the_title();
    }
    if (is_single()) {
        return get_the_title();
    }
    if (is_archive()) {
        if (is_category()) {
            return single_cat_title('', false);
        } elseif (is_tag()) {
            return single_tag_title('', false);
        } elseif (is_author()) {
            return get_the_author_meta('display_name');
        } elseif (is_date()) {
            return get_the_date();
        } elseif (is_post_type_archive()) {
            return post_type_archive_title('', false);
        }
    }
    if (is_search()) {
        return 'Resultados de búsqueda para: ' . get_search_query();
    }
    if (is_404()) {
        return 'Página no encontrada';
    }
    if (is_singular()) {
        $post_type = get_post_type();
        if ($post_type) {
            $post_type_object = get_post_type_object($post_type);
            return $post_type_object->labels->singular_name;
        }
    }
    if (is_tax()) {
        $term = get_queried_object();
        return single_term_title('', false);
    }
    if (is_home()) {
        return get_bloginfo('name');
    }
    return get_bloginfo('name');
}