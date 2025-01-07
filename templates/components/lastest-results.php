<?php
$query = new WP_Query(array(
    'post_type'      => 'resultados_y_secos',
    'post_status'    => 'publish',
    'posts_per_page' => 8,
    'order'          => 'DESC',
    'orderby'        => 'date',
));
?>

<h3 class="text-center mb-4">Últimos Resultados y Secos de Loterías</h3>
<div class="row row-cols-5 g-3">
    <?php
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $post_url = get_the_permalink();
            $post_date = get_the_date('j \d\e F, Y');
            $loteria_id = get_post_meta( $post_id, '_loteria_id', true );
            $loteria_thumbnail_url = get_the_post_thumbnail_url( $loteria_id, 'full' );
            $loteria_title = get_post( $loteria_id )->post_title;
            ?>
            <article class="col" id="resultado-<?php echo $post_id ?>">
                <div class="h-100 d-flex flex-column justify-content-between shadow-sm bg-body rounded-1 p-3">
                    <div class="w-50 ratio ratio-1x1 mx-auto mb-2">
                        <img class="object-fit-cover rounded-circle" src="<?php echo esc_url($loteria_thumbnail_url) ?>" alt="Logo de <?php echo $loteria_title ?>">
                    </div>
                    <h5 class="text-center mb-0"><?php echo $loteria_title ?></h5>
                    <p class="text-black-50 text-center mb-3"><?php echo $post_date ?></p>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary rounded-1 px-3" href="<?php echo esc_url($post_url) ?>">Resultado</a>
                    </div>
                </div>
            </article>
            <?php
        }
    } else {

    }
    ?>
</div>
