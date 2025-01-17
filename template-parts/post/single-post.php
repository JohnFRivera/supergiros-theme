<?php
$ID = get_the_ID();
$tags = wp_get_post_terms( $ID, 'post_tag' );
?>
<div class="container pt-5" style="min-height: 62vh;">
    <div class="row">
        <div class="col">
            <h3 class="mb-1"><?php echo get_the_title() ?></h3>
            <small class="text-black-50">
                <i class="bi bi-calendar me-1"></i>
                <?php echo get_the_date( 'j \d\e F, Y' ) ?>
            </small>
            <?php
            if ($tags) {
                echo '<div class="hstack gap-2 mt-2">';
                foreach ($tags as $tag) {
                    echo '<span class="badge rounded-1 text-bg-primary">' . $tag->name . '</span>';
                }
                echo '</div>';
            }
            ?>
            <hr class="my-3" />
            <?php echo wp_kses_post( get_post_field( 'post_content', $ID ) ) ?>
        </div>
    </div>
</div>