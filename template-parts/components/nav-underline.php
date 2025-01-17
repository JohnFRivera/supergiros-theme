<?php
$post_type = get_post_type();
$all_items = get_post_type_object( $post_type )->labels->all_items;
$taxonomy = get_object_taxonomies( $post_type )[0];
$terms = get_terms(array( 'taxonomy' => $taxonomy ));
$links = array(
    array(
        'text'  => $all_items,
        'href'  => home_url( $post_type.'/' ),
        'name'  => $post_type,
    ),
);
if(!is_wp_error($terms)) {
    foreach( $terms as $term ) {
        $links[] = array(
            'text'  => $term->name,
            'href'  => home_url( $post_type.'/'.$term->slug.'/' ),
            'name'  => $term->name,
        );
    }
}
?>
<nav class="nav nav-underline gap-1 mb-3">
    <?php
    foreach( $links as $link ) {
        $active = $link['name'] === get_queried_object()->name ? ' active' : '';
        $class = 'nav-link link-primary fw-medium border-3 py-2 px-3'.$active;
        $href = $link['href'];
        $text = $link['text'];
        echo '<a class="'.$class.'" href="'.$href.'">'.$text.'</a>';
    }
    ?>
</nav>