<?php
/* Template Name: Resultados de Sorteos y Loterías */
add_action('wp_enqueue_scripts', 'sgnv_resultados_scripts');
function sgnv_resultados_scripts() {
    wp_enqueue_script( 'supergiros-localstorage', get_template_directory_uri() . '/assets/js/localStorage.js', array(), null, true );
    wp_enqueue_script( 'supergiros-fetch', get_template_directory_uri() . '/assets/js/fetch.js', array(), null, true );
    wp_enqueue_script( 'supergiros-resultados', get_template_directory_uri() . '/assets/js/template-results.js', array(), null, true );
}

get_header();
?>
<main class="container-fluid bg-body-tertiary pt-4 pb-5">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="shadow banner-sorteos-loterias align-content-center mb-5 p-5">
                            <h2 class="position-relative z-2 text-white text-center text-uppercase fw-semibold mb-0"><?php echo get_the_title() ?></h2>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col align-content-end">
                        <h4 class="mb-0" id="title-results">Ultimos resultados</h4>
                    </div>
                    <div class="col-auto mx-auto">
                        <div class="d-flex align-items-center gap-3">
                            <label class="text-nowrap" for="ip-date">Fecha a consultar:</label>
                            <div class="w-100 shadow-sm bg-body rounded-1">
                                <input class="form-control-plaintext px-3" type="date" id="ip-date" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-6 g-3" id="row-results"></div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>