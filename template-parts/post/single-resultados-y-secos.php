<?php
$ID = get_the_ID();
$post_term = get_the_terms( $ID, 'loterias' )[0];
$logo = get_term_meta( $post_term->term_id, '_loteria_logotipo', true );
$title = $post_term->name;
?>

<main class="container-fluid bg-body-tertiary pt-4 pb-5">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="position-relative shadow banner-loterias rounded-1 mb-5 py-4 px-5">
                            <a class="position-absolute top-0 start-0 btn btn-light rounded-1 ms-5 mt-4" href="<?php echo home_url( 'loterias/resultados-y-secos/' ); ?>">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                            <h6 class="position-absolute top-0 end-0 text-white text-opacity-75 text-center fw-normal text-uppercase me-5 mt-4">RESULTADO DEL <?php echo get_the_date( 'j \d\e F, Y' ); ?></h6>
                            <div class="vstack">
                                <div class="ratio ratio-1x1 rounded-circle mx-auto" style="width: 10%">
                                    <img class="object-fit-cover rounded-circle" src="<?php echo esc_url( $logo ); ?>" alt="Logo de <?php echo $title; ?>" />
                                </div>
                                <h6 class="text-white text-opacity-75 text-center fw-normal text-uppercase mb-0">Lotería</h6>
                                <h3 class="text-white text-center fw-bold mb-2"><?php echo $title; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="d-flex flex-column align-items-center">
                            <?php echo wp_kses_post( get_post_field( 'post_content', $ID ) ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>