<?php
global $wp;
// Get locations
$menu_locations = get_nav_menu_locations();
if( !empty($menu_locations) ) {
	$location_key = is_user_logged_in() ? 'nav-private' : 'nav-public';
	$location_id = isset($menu_locations[$location_key]) ? $menu_locations[$location_key] : null;	
	$nav_menu_items = array();
	if( isset($location_id) ) {
		$nav_menu_items = wp_get_nav_menu_items($location_id);
	}
	// Get current url
	$current_url = home_url(add_query_arg(array(), $wp->request)) . '/';
	// Fill menu array
	$menu = array();
	foreach ( $nav_menu_items as $m ) {
		if ( empty( $m->menu_item_parent ) ) {
			$has_active = $m->url == $current_url ? true : false;
			$menu[$m->ID] = array();
			$menu[$m->ID]['ID']			= $m->ID;
			$menu[$m->ID]['title']		= $m->title;
			$menu[$m->ID]['url']		= $m->url;
			$menu[$m->ID]['active']		= $has_active;
			$menu[$m->ID]['children']	= array();
		}
	}
	// Fill submenu array
	$submenu = array();
	$active_flag = false;
	foreach ( $nav_menu_items as $m ) {
		if ( $m->menu_item_parent ) {
			$has_active = $m->url == $current_url ? true : false;
			$submenu[$m->ID] = array();
			$submenu[$m->ID]['ID']		= $m->ID;
			$submenu[$m->ID]['title']	= $m->title;
			$submenu[$m->ID]['url']		= $m->url;
			$submenu[$m->ID]['active']	= $has_active;
			$menu[$m->menu_item_parent]['children'][$m->ID]	= $submenu[$m->ID];
			if ( !$active_flag && $has_active ) {
				$menu[$m->menu_item_parent]['active'] = $has_active;
				$active_flag = true;
			}
		}
	}
	?>
	<nav class="container-xl">
		<ul class="nav nav-underline gap-1">
			<?php
			if( !empty($menu) ) {
				foreach( $menu as $item ) {
					$has_children = !empty($item['children']);
					// Fill navbar
					if( !$has_children ) {
						// Nav link
						$has_active = $item['active'] ? ' active' : '';
						?>
						<li class="nav-item" id="header-nav-<?php echo $item['ID']; ?>">
							<a href="<?php echo $item['url']; ?>" class="nav-change nav-link link-primary border-3 fw-semibold py-2 px-3<?php echo $has_active; ?>">
								<?php echo $item['title']; ?>
							</a>
						</li>
						<?php
					} else {
						$has_active = $item['active'] ? ' active' : '';
						?>
						<li class="nav-item dropdown" id="header-dropdown-<?php echo $item['ID']; ?>">
							<a href="<?php echo $item['url']; ?>" class="nav-link dropdown-toggle link-primary border-3 fw-semibold py-2 px-3<?php echo $has_active; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?php echo $item['title']; ?>
							</a>
							<ul class="dropdown-menu bg-light rounded-0 border-0 shadow-md py-0">
								<?php
								foreach ( $item['children'] as $item_children ) {
									$has_active = $item_children['active'] ? ' active' : '';
									$target = $item['title'] === 'Enlaces' ? '_Blank' : '';
									?>
									<li id="header-dropdown-item-<?php echo $item_children['ID']; ?>">
										<a href="<?php echo $item_children['url']; ?>" class="nav-change dropdown-item dropdown-primary<?php echo $has_active; ?>" target="<?php echo $target; ?>">
											<?php echo $item_children['title']; ?>
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
			}
			?>
		</ul>
	</nav>
	<?php
}
