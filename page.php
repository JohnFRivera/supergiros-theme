<?php
get_header();

$page_id = get_the_ID();
$page_thumbnail = get_the_post_thumbnail_url( $page_id, 'full' );
$page_title = get_the_title( $page_id );
$page_content = get_post_field('post_content', $page_id);
?>

<main class="container-fluid bg-body-tertiary pt-4 pb-5">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="shadow banner-pages rounded-1 mb-5 px-5" style="background-image: url(<?php echo $page_thumbnail ?>);">
                            <div class="position-relative z-2">
                                <h1 class="text-white text-center fw-bold mb-0"><?php echo esc_attr($page_title) ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo wp_kses_post($page_content) ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>