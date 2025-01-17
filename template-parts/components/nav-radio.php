<?php
$post_type = sgnv_get_post_type();
$all_items = get_post_type_object( $post_type )->labels->all_items;
$taxonomy = sgnv_get_taxonomy();
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
<nav class="d-flex flex-column gap-1">
    <?php
    foreach( $links as $link ) {
        $active = $link['name'] === get_queried_object()->name ? 'checked' : '';
        $href = $link['href'];
        $text = $link['text'];
        ?>
        <div class="position-relative form-check">
            <input class="form-check-input" type="radio" <?php echo $active ?>>
            <p class="form-check-label mb-0">
                <?php echo $text ?>
            </p>
            <a class="stretched-link" href="<?php echo $href ?>"></a>
        </div>
        <?php
    }
    ?>
</nav>