<?php
require_once sgnv_get_component( 'subtitle.php' );

$id = get_the_ID();
$title = get_the_title();
$thumbnail_url = get_the_post_thumbnail_url();
$tags = wp_get_post_terms( $id, 'etiquetas_noticias' );
$content = get_post_field('post_content', $id);

$args = array(
    'post_type'      => 'noticias',
    'order'          => 'DESC',
    'orderby'        => 'date',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
);
$query = new WP_Query( $args );
?>
<div class="container py-5">
    <div class="row gap-3">
        <main class="col">
            <?php
            echo '<a class="link-primary text-decoration-none mb-2" href="'.home_url('noticias').'">';
            sgnv_subtitle( '<i class="bi bi-arrow-left"></i> Noticias' );
            echo '</a>';
            ?>
            <div class="shadow-sm bg-body rounded-1 p-3">
                <div class="w-100 ratio ratio-16x9 mb-2">
                    <img class="rounded-1 border" src="<?php echo !empty( $thumbnail_url ) ? $thumbnail_url : sgnv_get_image_url( 'thumbnail-noticias.webp' ); ?>" alt="Miniatura de <?php echo $title ?>" />
                </div>
                <h3 class="mb-2"><?php echo $title ?></h3>
                <p class="text-dark text-opacity-75 mb-0"><?php echo get_the_date( 'j \d\e F, Y' ) ?></p>
                <?php
                if ($tags) {
                    echo '<div class="hstack gap-2 mt-3">';
                    foreach ($tags as $tag) {
                        echo '<span class="badge rounded-1 text-bg-primary">' . $tag->name . '</span>';
                    }
                    echo '</div>';
                }
                ?>
                <hr class="my-3" />
                <?php echo wp_kses_post( $content ) ?>
            </div>
        </main>
        <aside class="col-3">
            <section class="mb-4">
                <?php sgnv_subtitle( 'Otras noticias' ); ?>
                <div class="vstack gap-2">
                    <?php
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $thumbnail = get_the_post_thumbnail_url();
                            ?>
                            <article class="position-relative post-translate-x hstack gap-2 shadow-sm bg-body rounded-1 p-2" id="noticia-<?php echo get_the_ID(); ?>">
                                <div class="w-25 ratio ratio-16x9">
                                    <img class="object-fit-cover rounded-1 border" src="<?php echo esc_url($thumbnail ? $thumbnail : sgnv_get_image_url('thumbnail-noticias.webp')); ?>" alt="Portada de <?php echo get_the_title(); ?>">
                                </div>
                                <div class="vstack justify-content-center">
                                    <h6 class="mb-0"><?php echo get_the_title(); ?></h6>
                                    <small class="text-dark text-opacity-75"><?php echo get_the_date('j \d\e F, Y'); ?></small>
                                </div>
                                <a class="stretched-link" href="<?php echo esc_url(get_the_permalink()); ?>"></a>
                            </article>
                            <?php
                        }
                        wp_reset_postdata();
                    }
                    ?>
                </div>
            </section>
            <section>
                <?php
                sgnv_subtitle( 'Redes sociales' );
                get_template_part('/template-parts/components/social-media');
                ?>
            </section>
        </aside>
    </div>
</div>
