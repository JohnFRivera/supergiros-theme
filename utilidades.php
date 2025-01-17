<?php
/* Template Name: Utilidades */

get_header();
?>
<main class="container-fluid bg-body-tertiary pt-4 pb-5">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="shadow banner-noticias rounded-1 align-content-center mb-5 p-5">
                            <h2 class="position-relative z-2 text-white text-center text-uppercase fw-semibold mb-0"><?php echo get_the_title() ?></h2>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-6" style="min-height: 40vh;">
                    <div class="col">
                        <div class="position-relative d-flex flex-column post-translate">
                            <div class="ratio ratio-1x1 shadow-sm bg-body rounded-1 mx-auto mb-2" style="width: 80px;height: 80px;">
                                <img class="object-fit-cover rounded-1" src="https://10.25.1.9/ssvsa/wp-content/themes/ssvsa/assets/img/apps/bitrix.jpg" alt="" />
                            </div>
                            <h5 class="text-center">Bitrix</h5>
                            <a href="" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
