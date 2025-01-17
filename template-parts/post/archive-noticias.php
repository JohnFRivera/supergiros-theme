<?php
require_once sgnv_get_component( 'subtitle.php' );
?>
<div class="container">
    <div class="row gap-3">
        <main class="col">
            <section class="mb-3">
                <?php sgnv_subtitle( 'Más recientes' ); ?>
                <div class="row row-cols-2 g-3" id="row-recientes"></div>
            </section>
            <section>
                <?php get_template_part( '/template-parts/components/nav-underline' ); ?>
                <input type="hidden" id="term" value="<?php echo esc_attr( sgnv_get_term() ); ?>">
                <div class="row row-cols-4 g-3" id="row-noticias"></div>
                <div class="row" id="paginator"></div>
            </section>
        </main>
        <aside class="col-3">
            <section class="mb-4">
                <?php
                sgnv_subtitle( 'Buscador' );
                get_template_part('/template-parts/components/searcher');
                ?>
            </section>
            <section class="mb-4">
                <?php
                sgnv_subtitle( 'Ordenar' );
                get_template_part('/template-parts/components/order');
                ?>
            </section>
            <section class="mb-5">
                <?php
                sgnv_subtitle( 'Redes sociales' );
                get_template_part('/template-parts/components/social-media');
                ?>
            </section>
            <section>
                <?php
                $ad_image = get_theme_mod( 'noticias_ads_image' );
                $ad_url = get_theme_mod( 'noticias_ads_url' );
                if ( !empty( $ad_image ) ) {
                    echo '<a href="'.esc_url( $ad_url ).'" target="__Blank">';
                    echo '<div class="w-100 ratio ratio-1x1">';
                    echo '<img class="object-fit-cover shadow-sm rounded-1" src="'.esc_url( $ad_image ).'" alt="Anuncio de sección noticias" />';
                    echo '</div>';
                    echo '</a>';
                }
                ?>
            </section>
        </aside>
    </div>
</div>
