<aside class="col-3">
    <section class="mb-4">
        <h5 class="mb-2">Buscador</h5>
        <?php get_template_part('/templates/components/searcher') ?>
    </section>
    <section class="mb-4">
        <h5 class="mb-2">Ordenar</h5>
        <?php get_template_part('/templates/components/order') ?>
    </section>
    <section class="mb-5">
        <h5 class="mb-2">Categorías</h5>
        <?php get_template_part('/templates/parts/nav-documentos') ?>
    </section>
    <section>
        <a href="<?php echo esc_url(get_theme_mod('documentos_ads_url')) ?>" target="__Blank">
            <img class="w-100 ratio ratio-1x1 object-fit-cover shadow-sm rounded-1" src="<?php echo esc_url(get_theme_mod('documentos_ads_image')) ?>" alt="Anuncio de sección Documentos" />
        </a>
    </section>
</aside>