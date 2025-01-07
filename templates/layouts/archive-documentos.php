<?php
$args = array(
    'post_type' => 'documentos',
    'taxonomy'  => 'categoria_documentos'
);
$categories = get_terms( $args );

$page = get_queried_object();
$term = $page->name === 'documentos' ? '' : $page->slug;
?>

<input type="hidden" id="ip-term" value="<?php echo esc_attr($term) ?>">
<div class="container-fluid bg-body-tertiary py-5">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row gap-3">
                    <main class="col">
                        <section>
                            <h5 class="mb-2">
                                <?php echo $page->name === 'documentos' ? 'Ver todos' : $page->name ?>
                            </h5>
                            <div class="row row-cols-4 g-3" id="loop-documentos"></div>
                            <div class="row" id="divPaginator"></div>
                        </section>
                    </main>
                    <?php get_template_part('/templates/parts/aside-documentos') ?>
                </div>
            </div>
        </div>
    </div>
</div>