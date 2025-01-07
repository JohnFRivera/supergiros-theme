<?php
$id = get_the_ID();
$title = get_the_title( $id );
$date = get_the_date( 'j \d\e F, Y' );
$thumbnail_url = get_the_post_thumbnail_url( $id, 'full' );
$content = get_post_field('post_content', $id);
?>

<div class="container-fuid bg-body-tertiary py-5">
    <div class="row g-0">
        <div class="col">
            <div class="container">
                <div class="row gap-3">
                    <main class="col">
                        <a class="link-primary text-decoration-none mb-2" href="<?php echo esc_url(home_url('noticias')) ?>">
                            <h5>
                                <i class="bi bi-arrow-left"></i>
                                Noticias
                            </h5>
                        </a>
                        <div class="shadow-sm bg-body rounded-1 p-3">
                            <div class="w-100 ratio ratio-16x9 mb-3">
                                <img class="rounded-1 border" src="<?php echo esc_url($thumbnail_url) ?>" alt="Miniatura de <?php echo esc_attr($title) ?>" />
                            </div>
                            <h2 class="mb-2"><?php echo esc_attr( $title ) ?></h2>
                            <p class="text-dark text-opacity-75"><?php echo esc_attr( $date ) ?></p>
                            <hr class="my-4" />
                            <?php echo wp_kses_post($content) ?>
                        </div>
                    </main>
                    <?php get_template_part( '/templates/parts/aside-single-noticias' ) ?>
                </div>
            </div>
        </div>
    </div>
</div>