<?php
$id = get_the_ID();
$title = get_the_title( $id );
$date = get_the_date( 'j \d\e F, Y' );
$content = get_post_field('post_content', $id);
?>

<main class="container-fluid bg-body-tertiary py-5">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h2><?php echo esc_attr( $title ) ?></h2>
                        <p class="text-dark text-opacity-50"><?php echo esc_attr( $date ) ?></p>
                        <hr class="mb-5" />
                        <?php echo wp_kses_post($content) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>