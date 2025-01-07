<?php
get_header();

$post_type = get_post_type();
if (empty($post_type)) {
    $queried_object = get_queried_object();
    $taxonomy_object = get_taxonomy($queried_object->taxonomy);
    $post_type = $taxonomy_object->object_type[0];
}
get_template_part( '/templates/layouts/archive', $post_type );

get_footer();
?>