<?php
if ( is_user_logged_in() ) {
	$current_user = wp_get_current_user();
	if ( in_array( 'administrator', $current_user->roles ) || in_array( 'editor', $current_user->roles ) ) {
		$post_type = get_post_type();
		$post_type_object = get_post_type_object($post_type);
		if( $post_type_object && isset($post_type_object->labels->add_new) ) {
			?>
			<div class="col">
				<a href="<?php echo site_url("wp-admin/post-new.php?post_type={$post_type}"); ?>" class="btn btn-primary rounded-pill shadow" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $post_type_object->labels->add_new_item; ?>">
					<i class="bi bi-plus-lg"></i>
					<?php echo $post_type_object->labels->add_new; ?>
				</a>
			</div>
			<?php
		}
	}
}
