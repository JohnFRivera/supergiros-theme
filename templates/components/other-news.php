<?php
$args = array(
    'post_type'      => 'noticias',
    'order'          => 'DESC',
    'orderby'        => 'date',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
);
$query = new WP_Query( $args );
?>

<div class="vstack gap-2">
    <?php
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $post_url = get_the_permalink();
            $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'full' );
            $post_title = get_the_title();
            $post_date = get_the_date('j \d\e F, Y');
            ?>
            <article class="position-relative hstack gap-2 shadow-sm bg-body rounded-1 p-2" id="<?php echo esc_html( $post_id ) ?>">
                <div class="w-25 ratio ratio-16x9">
                    <img class="rounded-1 border" src="<?php echo esc_url( $post_thumbnail_url ) ?>" alt="Portada de <?php echo esc_html( $post_title ) ?>">
                </div>
                <div class="vstack justify-content-center">
                    <h6 class="mb-0"><?php echo esc_html( $post_title ) ?></h6>
                    <small class="text-dark text-opacity-75"><?php echo esc_html( $post_date ) ?></small>
                </div>
                <a class="stretched-link" href="<?php echo esc_url( $post_url ) ?>"></a>
            </article>
            <?php
        }
    }
    ?>
</div>