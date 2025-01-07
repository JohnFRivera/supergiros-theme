<?php
$terms = get_terms(array(
    'post_type'  => 'noticias',
    'taxonomy'   => 'categoria_noticias',
    'hide_empty' => false,
));
?>

<nav class="nav nav-underline border-bottom gap-1 mb-3">
    <?php
    $page_selected = get_queried_object()->name;
    $nav_active = $page_selected === 'noticias' ? true : false;
    ?>
    <a class="nav-link link-primary fw-medium border-3 px-2<?php echo $nav_active ? ' active' : '' ?>" href="<?php echo home_url('noticias') ?>">
        Ver todas
    </a>
    <?php
    if($terms) {
        foreach($terms as $term) {
            $nav_active = $page_selected === $term->name ? true : false;
            ?>
            <a class="nav-link link-primary fw-medium border-3 px-2<?php echo $nav_active ? ' active' : '' ?>" href="<?php echo home_url('noticias/' . $term->slug . '/') ?>">
                <?php echo esc_attr($term->name) ?>
            </a>
            <?php
        }
    }
    ?>
</nav>