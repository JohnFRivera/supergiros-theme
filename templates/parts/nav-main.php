<?php
$navbar = [];
$locations = get_nav_menu_locations();
if (is_user_logged_in()) {
    $menu_id = isset($locations['nav-private']) ? $locations['nav-private'] : null;
} else {
    $menu_id = isset($locations['nav-public']) ? $locations['nav-public'] : null;
}
if ($menu_id) {
    $menu_items = wp_get_nav_menu_items($menu_id);
    if ($menu_items) {
        foreach ($menu_items as $menu_item) {
            if ($menu_item->menu_item_parent == 0) {
                $navbar[$menu_item->ID] = [
                    'item' => $menu_item,
                    'children' => [],
                ];
            } else {
                $navbar[$menu_item->menu_item_parent]['children'][] = $menu_item;
            }
        }
    }
}
?>

<nav class="container">
    <ul class="nav nav-underline gap-1">
        <?php
        if ($navbar) {
            $page_title = get_the_title();
            foreach($navbar as $navbar_item) {
                $item = $navbar_item['item'];
                $has_children = !empty($navbar_item['children']);
                $active_a = $_SERVER['REQUEST_URI'] === $item->url ? ' active' : '';
                if (!$has_children) {
                    // Botones normales
                    ?>
                    <li class="nav-item">
                        <a class="nav-link link-primary border-3 fw-semibold py-2 px-3<?php echo $active_a ?>" href="<?php echo esc_url($item->url) ?>">
                            <?php echo esc_html($item->title) ?>
                        </a>
                    </li>
                    <?php
                } else {
                    // Botones con submenus
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle link-primary border-3 fw-semibold py-2 px-3<?php echo $active_a ?>" href="<?php echo esc_url($item->url) ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo esc_html($item->title) ?>
                        </a>
                        <ul class="dropdown-menu bg-light rounded-0 border-0 shadow py-0">
                            <?php
                            foreach ($navbar_item['children'] as $item_children) {
                                // Usamos parse_url() para descomponer la URL
                                $parsed_url = parse_url($item_children->url);
                                // Obtener solo la ruta
                                $path = isset($parsed_url['path']) ? $parsed_url['path'] : ''; 
                                $active_dropdown = $_SERVER['REQUEST_URI'] === esc_url($path) ? ' active' : '';
                                ?>
                                <li>
                                    <a class="dropdown-item dropdown-primary<?php echo $active_dropdown ?>" href="<?php echo esc_url($path) ?>">
                                        <?php echo esc_html($item_children->title) ?>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                }
            }
        } else {
            ?>
            <h6 class="w-100 text-light text-center">No hay ningún menú seleccionado</h6>
            <?php
        }
        ?>
    </ul>
</nav>