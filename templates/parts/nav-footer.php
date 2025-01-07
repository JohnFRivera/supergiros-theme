<?php
$locations = get_nav_menu_locations();
$menu_id = isset($locations['nav-footer']) ? $locations['nav-footer'] : null;
?>

<ul class="d-flex flex-column gap-3 list-unstyled mb-4">
    <?php
    if ($menu_id) {
        $menu_items = wp_get_nav_menu_items($menu_id);
        if ($menu_items) {
            foreach ($menu_items as $menu_item) {
                ?>
                <li>
                    <a class="link-light link-opacity-75 link-opacity-100-hover link-underline-opacity-0 link-underline-opacity-100-hover" href="#">
                        <?php echo esc_attr( $menu_item->title ) ?>
                    </a>
                </li>
                <?php
            }
        }
    }
    ?>
</ul>