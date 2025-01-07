<?php
$id = get_the_ID();
$date = get_the_date( 'j \d\e F, Y' );
$loteria_resultado = get_post_meta( $id, '_resultado_image', true );
$loteria_id = get_post_meta( $id, '_loteria_id', true );
$loteria_thumbnail_url = get_the_post_thumbnail_url( $loteria_id, 'full' );
$loteria_title = get_post( $loteria_id )->post_title;
?>

<main class="container-fluid bg-body-tertiary pt-4 pb-5">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="position-relative shadow banner-loterias rounded-1 mb-5 py-4 px-5">
                            <a class="position-absolute top-0 start-0 btn btn-light rounded-1 ms-5 mt-4" href="<?php echo esc_url(home_url('loterias/resultados-y-secos/')) ?>">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                            <div class="vstack">
                                <div class="ratio ratio-1x1 rounded-circle mx-auto mb-3" style="width: 10%">
                                    <img class="object-fit-cover rounded-circle" src="<?php echo esc_url( $loteria_thumbnail_url ) ?>" alt="Logo de <?php echo esc_attr( $loteria_title ) ?>" />
                                </div>
                                <h6 class="text-white text-opacity-75 text-center fw-normal text-uppercase mb-0">Resultado del <?php echo esc_attr($date) ?></h6>
                                <h3 class="text-white text-center fw-bold mb-2"><?php echo esc_attr($loteria_title) ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <img class="w-75 d-block shadow-sm rounded-1 mx-auto" src="<?php echo esc_url( $loteria_resultado ) ?>" alt="Resultado de <?php echo esc_html( $loteria_title ) . ' el ' . esc_html( $date ) ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>