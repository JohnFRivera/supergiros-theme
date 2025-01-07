<?php
$args = array(
    'post_type'      => 'planes_de_premios',
    'posts_per_page' => -1,
    'fields'         => 'ids',
);
$query = new WP_Query($args);
?>

<main class="container-fluid bg-body-tertiary py-5">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h6 class="text-center text-uppercase">LOTERÍAS</h6>
                        <h2 class="text-center fw-bold mb-5">Resultados y Secos</h2>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col align-content-end">
                        <h6 class="mb-0">
                            <span id="span-counter">0</span>
                            LOTERÍAS
                        </h6>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex gap-3">
                            <div class="shadow-sm rounded-1">
                                <select class="form-select rounded-1 border-0 shadow-none w-auto ps-3" id="sl-loteria">
                                    <?php
                                    if ($query->have_posts()) :
                                        ?>
                                        <option value="">Todas las loterías</option>
                                        <?php
                                        while ($query->have_posts()) : $query->the_post();
                                            ?>
                                            <option value="<?php echo esc_attr(get_the_ID()) ?>">
                                                <?php echo esc_attr(get_the_title()) ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    else :
                                        ?>
                                        <option value="">No hay loterías</option>
                                        <?php
                                    endif;
                                    ?>
                                </select>
                            </div>
                            <div class="shadow-sm rounded-1">
                                <select class="form-select rounded-1 border-0 shadow-none w-auto ps-3" id="sl-year">
                                    <option value="">Todos los años</option>
                                </select>
                            </div>
                            <div class="shadow-sm rounded-1">
                                <select class="form-select rounded-1 border-0 shadow-none w-auto ps-3 d-none" id="sl-month">
                                    <option value="">Todos los meses</option>
                                </select>
                            </div>
                            <div class="shadow-sm rounded-1">
                                <select class="form-select rounded-1 border-0 shadow-none w-auto ps-3 d-none" id="sl-day">
                                    <option value="">Todos los días</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-5 g-3" id="loop-container"></div>
                <div class="row" id="divPaginator"></div>
            </div>
        </div>
    </div>
</main>