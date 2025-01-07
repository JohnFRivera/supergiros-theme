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
            <img src="<?php echo esc_url(supergiros_get_image_url('icon-chance.png')) ?>" alt="Icono de Chance" width="20" height="20" />
        </button>
    </div>
</div>
<main>
    <?php get_template_part('/templates/components/carousel') ?>
    <article class="container-fluid bg-body-tertiary">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row h-screen">
                        <div class="col align-content-center">
                            <?php get_template_part( '/templates/components/lastest-news' ) ?>
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
                            <?php get_template_part( '/templates/components/lastest-results' ) ?>
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
                            <?php get_template_part( '/templates/components/table-lottery-results' ) ?>
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
                            <?php get_template_part( '/templates/components/chance-simulator' ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>

<?php get_footer(); ?>