<?php
$page = get_queried_object();
$term = $page->name === 'noticias' ? '' : $page->slug;
?>

<input type="hidden" id="ip-term" value="<?php echo esc_attr($term) ?>">
<div class="container-fluid bg-body-tertiary py-5">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row gap-3">
                    <main class="col">
                        <section class="mb-3">
                            <h5 class="mb-2">Mas recientes</h5>
                            <div class="row row-cols-2 g-3" id="loop-ultima-noticia"></div>
                        </section>
                        <section>
                            <?php get_template_part('/templates/parts/nav-noticias') ?>
                            <div class="row row-cols-4 g-3" id="loop-noticias"></div>
                            <div class="row" id="divPaginator"></div>
                        </section>
                    </main>
                    <?php get_template_part('/templates/parts/aside-noticias') ?>
                </div>
            </div>
        </div>
    </div>
</div>