<aside class="col-3">
    <section class="mb-4">
        <h5 class="mb-2">Otras noticias</h5>
        <?php get_template_part('/templates/components/other-news') ?>
    </section>
    <section>
        <h5 class="mb-0">Redes sociales</h5>
        <?php get_template_part('/templates/components/social-media') ?>
    </section>
    <section>
        <a href="<?php echo esc_url(get_theme_mod('ad_url_1')) ?>" target="__Blank">
            <div class="w-100 ratio ratio-1x1">
                <img class="object-fit-cover shadow-sm rounded-1" src="<?php echo esc_url(get_theme_mod('ad_image_1')) ?>" alt="Anuncio de sección Noticias" />
            </div>
        </a>
    </section>
</aside>