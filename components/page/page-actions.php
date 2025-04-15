<?php
if( is_user_logged_in() ) {
	$current_user = wp_get_current_user();
	if ( in_array('administrator', $current_user->roles) || in_array('editor', $current_user->roles) ) {
		wp_enqueue_script(
			'post-actions',
			get_template_directory_uri() . '/js/components/post-actions.js',
			array(),
			null,
			true
		);
		wp_localize_script('post-actions', 'wpApiSettings', [
			'nonce' => wp_create_nonce('wp_rest'),
		]);
		$ID = get_the_ID();
		?>
		<div class="position-absolute top-0 end-0 mt-2 pe-3 z-2">
			<div class="hstack gap-3">
				<a href="<?php echo site_url("wp-admin/post.php?post={$ID}&action=edit"); ?>" class="btn text-white border-0 p-0" target="_blank">
					<i class="bi bi-pencil-square me-2"></i>Editar
				</a>
				<div class="vr bg-white"></div>
				<button type="button" class="btn text-white border-0 p-0" data-bs-toggle="modal" data-bs-target="#deletePost">
					<i class="bi bi-trash me-2"></i>Eliminar
				</button>
			</div>
		</div>
		<div class="modal fade" id="deletePost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deletePostLabel" aria-hidden="true">
			<div class="modal-dialog h-100 d-flex align-items-center">
				<div class="modal-content border-0 mb-5">
					<div class="modal-header bg-danger bg-gradient">
						<p class="text-white fw-semibold fs-5 mb-0" id="deletePostLabel">
							<i class="bi bi-exclamation-triangle-fill"></i> ¡Advertencia!
						</p>
					</div>
					<div class="modal-body">
						¿Estás seguro de que deseas eliminar <span class="fw-semibold">"<?php echo get_the_title(); ?>"</span>?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
						<button type="button" id="btnDeletePost" data-id="<?php echo $ID; ?>" class="btn btn-danger">Eliminar</button>
					</div>
				</div>
			</div>
		</div>
		<?php
	};
};
