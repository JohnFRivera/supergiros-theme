<?php
global $wp;
// Get locations
$menu_locations = get_nav_menu_locations();
if( !empty($menu_locations) ) {
	$location_id = isset($menu_locations['nav-footer']) ? $menu_locations['nav-footer'] : null;	
	$nav_menu_items = array();
	if( isset($location_id) ) {
		$nav_menu_items = wp_get_nav_menu_items($location_id);
	}
	// Fill menu array
	$menu = array();
	foreach ( $nav_menu_items as $m ) {
		$menu[$m->ID] 			= array();
		$menu[$m->ID]['ID']		= $m->ID;
		$menu[$m->ID]['type']	= $m->type;
		$menu[$m->ID]['title'] 	= $m->title;
		$menu[$m->ID]['url']	= $m->url;
	}
	?>
	<div class="align-content-center mb-4" style="height: 52px;">
		<h5 class="text-light mb-0">Información</h5>
	</div>
	<ul class="d-flex flex-column gap-3 list-unstyled mb-4">
		<?php
		if( !empty($menu) ) {
			foreach( $menu as $item ) {
				$target = $item['type'] === 'custom' ? '_Blank' : '';
				?>
				<li id="footer-nav-<?php echo $item['ID']; ?>">
					<a class="link-light link-opacity-75 link-opacity-100-hover link-underline-opacity-0 link-underline-opacity-100-hover" href="<?php echo $item['url']; ?>" target="<?php echo $target; ?>">
						<?php echo $item['title']; ?>
					</a>
				</li>
				<?php
			}
		}
		?>
	</ul>
	<?php
}
