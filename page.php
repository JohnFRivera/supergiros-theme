<?php
get_header();
$ID = get_the_ID();
?>

<main class="container-fluid bg-body-tertiary pt-4 pb-5">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="shadow banner-pages mb-5 px-5" style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url() ) ?>);">
                            <h2 class="position-relative z-2 text-white text-center text-uppercase fw-semibold mb-0"><?php echo get_the_title() ?></h2>
                        </div>
                        <?php echo wp_kses_post( get_post_field( 'post_content', $ID ) ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>