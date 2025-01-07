<?php
$id = get_the_ID();
$thumbnail_url = get_the_post_thumbnail_url( $id, 'full' );
$title = get_the_title( $id );
$date = get_the_date( 'j \d\e F, Y' );
$content = get_post_field('post_content', $id);
?>

<main class="container-fluid bg-body-tertiary pt-4 pb-5">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="position-relative shadow banner-loterias rounded-1 mb-5 py-4 px-5">
                            <a class="position-absolute top-0 start-0 btn btn-light rounded-1 ms-5 mt-4" href="<?php echo esc_url(home_url('loterias/planes-de-premios')) ?>">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                            <div class="vstack">
                                <div class="ratio ratio-1x1 rounded-circle mx-auto mb-3" style="width: 10%">
                                    <img class="object-fit-cover rounded-circle" src="<?php echo esc_url( $thumbnail_url ) ?>" alt="Logo de <?php echo esc_attr( $title ) ?>" />
                                </div>
                                <h6 class="text-white text-opacity-75 text-center fw-normal text-uppercase mb-0">Lotería</h6>
                                <h3 class="text-white text-center fw-bold mb-2"><?php echo esc_attr($title) ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="d-flex flex-column align-items-center">
                            <?php echo wp_kses_post($content) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>