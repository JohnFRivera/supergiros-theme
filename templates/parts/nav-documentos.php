<?php
$terms = get_terms(array(
    'post_type'  => 'documentos',
    'taxonomy'   => 'categoria_documentos',
    'hide_empty' => false,
));
?>

<nav class="nav flex-column gap-1 mb-3">
    <?php
    $page_selected = get_queried_object()->name;
    $nav_active = $page_selected === 'documentos' ? true : false;
    ?>
    <a class="nav-link link-primary fw-medium p-0<?php echo $nav_active ? ' border-end border-3 border-primary' : '' ?>" href="<?php echo home_url('documentos') ?>">
        Ver todos
    </a>
    <?php
    if($terms) {
        foreach($terms as $term) {
            $nav_active = $page_selected === $term->name ? true : false;
            ?>
            <a class="nav-link link-primary fw-medium p-0<?php echo $nav_active ? ' border-end border-3 border-primary' : '' ?>" href="<?php echo home_url('documentos/' . $term->slug . '/') ?>">
                <?php echo esc_attr($term->name) ?>
            </a>
            <?php
        }
    }
    ?>
</nav>