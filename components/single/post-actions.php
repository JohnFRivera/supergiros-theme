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
		<div class="position-absolute top-0 end-0 mt-4 pe-4">
			<div class="dropdown">
				<button type="button" class="btn border-0 fs-5 p-0" data-bs-toggle="dropdown" aria-expanded="false">
					<i class="bi bi-three-dots-vertical"></i>
				</button>
				<ul class="dropdown-menu dropdown-menu-end rounded border shadow-md overflow-hidden p-0">
					<li>
						<a href="<?php echo site_url("wp-admin/post.php?post={$ID}&action=edit"); ?>" class="dropdown-item dropdown-edit" target="_blank">
							<i class="bi bi-pencil-square me-2"></i>Editar
						</a>
					</li>
					<li>
						<button type="button" class="dropdown-item dropdown-danger" data-bs-toggle="modal" data-bs-target="#deletePost">
							<i class="bi bi-trash me-2"></i>Eliminar
						</button>
					</li>
				</ul>
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
