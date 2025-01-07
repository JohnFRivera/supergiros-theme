<?php
$terms = get_terms(array(
    'post_type' => 'noticias',
    'taxonomy' => 'categoria_noticias',
    'hide_empty' => false,
));
?>

<h3 class="text-center mb-4">Últimas Noticias</h3>
<nav class="nav nav-underline gap-1 border-bottom mb-3">
    <?php
    if ($terms) {
        foreach ($terms as $term) {
            ?>
            <button class="categoria-noticias nav-link link-primary fw-medium border-3 px-2" type="button" id="<?php echo esc_attr( $term->slug ) ?>">
                <?php echo esc_attr( $term->name ) ?>
            </button>
            <?php
        }
    }
    ?>
</nav>
<section class="row row-cols-4 g-3" id="loop-last-news"></section>
