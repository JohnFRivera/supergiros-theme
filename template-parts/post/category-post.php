<?php
$queried_object = get_queried_object();
?>
<main class="container">
    <div class="row">
        <div class="col">
            <?php
            $description = $queried_object->description;
            if ( isset($description) && !empty( $description ) ) {
                echo '<h5 class="text-center text-uppercase fw-normal">'.$description.'</h5>';
            }
            ?>
            <h2 class="text-center fw-bold mb-5"><?php echo $queried_object->name ?></h2>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-auto d-flex align-items-center gap-3 ms-auto">
            <label for="">Ordenar por:</label>
            <?php get_template_part( '/template-parts/components/order' ); ?>
        </div>
        <div class="col-3">
            <?php get_template_part( '/template-parts/components/searcher' ); ?>
        </div>
    </div>
    <?php
    echo '<input type="hidden" id="term" value="'.$queried_object->slug.'">';
    ?>
    <div class="row row-cols-4 g-3" id="row-posts"></div>
    <div class="row" id="paginator"></div>
</main>
