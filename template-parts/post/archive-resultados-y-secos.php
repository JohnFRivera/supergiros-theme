<?php
$lotteries = get_terms(array(
    'taxonomy'   => 'loterias',
    'orderby'    => 'name',
    'order'      => 'ASC',
));
?>
<main class="container" style="min-height: 58vh;">
    <div class="row">
        <div class="col">
            <h6 class="text-center text-uppercase fw-normal">LOTERÍAS</h6>
            <h2 class="text-center fw-bold mb-5">Resultados y Secos</h2>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-auto ms-auto">
            <div class="d-flex gap-3">
                <div class="shadow-sm rounded-1">
                    <select class="w-100 form-select shadow-none bg-body border-0 rounded-1 ps-3" name="sl-lottery" id="sl-lottery">
                        <option value="">Todas las loterías</option>
                        <?php
                        foreach( $lotteries as $lottery ) {
                            echo '<option value="'.$lottery->slug.'">'.$lottery->name.'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="shadow-sm rounded-1">
                    <select class="w-100 form-select shadow-none bg-body border-0 rounded-1 ps-3" name="sl-year" id="sl-year">
                        <option value="">Todas las años</option>
                    </select>
                </div>
                <div class="shadow-sm rounded-1">
                    <select class="w-100 form-select shadow-none bg-body border-0 rounded-1 ps-3 d-none" name="sl-month" id="sl-month">
                        <option value="">Todas las meses</option>
                    </select>
                </div>
                <div class="shadow-sm rounded-1">
                    <select class="w-100 form-select shadow-none bg-body border-0 rounded-1 ps-3 d-none" name="sl-day" id="sl-day">
                        <option value="">Todas las días</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-5 g-3" id="row-loterias"></div>
    <div class="row" id="divPaginator"></div>
</main>