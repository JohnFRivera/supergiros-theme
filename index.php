<?php
get_header();
?>
<div class="position-fixed end-0 top-50 translate-middle-y z-3 me-2">
    <div class="vstack gap-2 shadow bg-white rounded-1 p-2">
        <button class="btn btn-secondary rounded-1" type="button" id="btnScrollTop">
            <i class="bi bi-chevron-double-up"></i>
        </button>
        <button class="btn btn-secondary rounded-1" type="button" id="btnScrollNoticias">
            <i class="bi bi-newspaper"></i>
        </button>
        <button class="btn btn-secondary rounded-1" type="button" id="btnScrollSecos">
            <i class="bi bi-ticket"></i>
        </button>
        <button class="btn btn-secondary rounded-1" type="button" id="btnScrollSorteos">
            <i class="bi bi-calendar"></i>
        </button>
        <button class="btn btn-secondary rounded-1" type="button" id="btnScrollChance">
            <img src="<?php echo sgnv_get_image_url( 'logos/icon-chance.png' ) ?>" alt="Icono de Chance" width="20" height="20" />
        </button>
    </div>
</div>
<main>
    <?php get_template_part('/template-parts/components/carousel') ?>
    <article class="container-fluid bg-body-tertiary">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row h-screen">
                        <div class="col align-content-center">
                            <h4 class="text-center mb-4">Últimas Noticias</h4>
                            <?php
                            $all_items = get_post_type_object( 'noticias' )->labels->all_items;
                            $terms = get_terms(array( 'taxonomy' => 'tipos_noticias' ));
                            $links = array(
                                array(
                                    'text'  => $all_items,
                                    'href'  => '#noticias',
                                ),
                            );
                            if(!is_wp_error($terms)) {
                                foreach( $terms as $term ) {
                                    $links[] = array(
                                        'text'  => $term->name,
                                        'href'  => '#'.$term->slug,
                                    );
                                }
                            }
                            ?>
                            <nav class="nav nav-underline border-bottom gap-1 mb-3">
                                <?php
                                foreach( $links as $link ) {
                                    echo '<a class="nav-noticias nav-link link-primary fw-medium border-3 py-2 px-3" href="'.$link['href'].'">'.$link['text'].'</a>';
                                }
                                ?>
                            </nav>
                            <input type="hidden" id="term" value="">
                            <div style="height: 447.56px;">
                                <div class="row row-cols-5 g-3" id="row-noticias"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <article class="container-fluid bg-body-secondary">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row h-screen">
                        <div class="col align-content-center">
                            <h4 class="text-center mb-4">Últimos Resultados y Secos de Loterías</h4>
                            <div style="height: 530.38px;">
                                <div class="row row-cols-5 g-3" id="row-loterias"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <article class="container-fluid banner-sorteos-loterias">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row h-screen">
                        <div class="col-9 align-content-center mx-auto z-1">
                            <h4 class="text-white text-center mb-4">Últimos Resultados de Hoy</h4>
                            <div class="shadow mb-4">
                                <div class="bg-body-secondary rounded-top-1 py-3 px-4">
                                    <div class="d-flex justify-content-between">
                                        <div class="align-content-center">
                                            <h5 class="mb-0">SORTEOS Y LOTERÍAS</h5>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <label for="ip-lottery-results-date">Consultar día:</label>
                                            <div class="shadow-sm rounded-1">
                                                <input class="form-control shadow-none bg-white rounded-1 border-0 w-auto ms-auto" type="date" id="ip-resultados" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-sorteos bg-white rounded-bottom-1 pb-3">
                                    <table class="table table-hover mb-0">
                                        <tbody id="row-resultados"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <article class="container-fluid bg-body-secondary">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row h-screen">
                        <div class="col-6 align-content-center mx-auto">
                            <?php get_template_part( '/template-parts/components/chance-simulator' ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>

<?php get_footer(); ?>