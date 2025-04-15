<?php
if ( is_user_logged_in() ) {
	$current_user 		= wp_get_current_user();
	$user_avatar_url 	= get_avatar_url( $current_user->user_email );
	$user_name 			= implode(' ', array_map('ucfirst', explode('.', $current_user->user_login)));
	$user_role 			= '';
	switch ($current_user->roles[0]) {
		case 'administrator':
			$user_role = 'Administrador';
			break;
		default:
			$user_role = ucfirst( $current_user->roles[0] );
			break;
	}
	?>
	<div class="dropdown">
		<button class="hstack gap-2 bg-transparent border-0 text-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
			<img class="rounded-circle" src="<?php echo $user_avatar_url; ?>" alt="Foto de perfil" width="34px" height="34px">
			<div class="vstack">
				<h6 class="text-light text-start fw-semibold mb-0"><?php echo $user_name; ?></h6>
				<small class="text-light text-opacity-50 text-start lh-1 mb-0"><?php echo $user_role; ?></small>
			</div>
		</button>
		<ul class="dropdown-menu dropdown-menu-end bg-light rounded-0 border-0 shadow mt-2 py-0">
			<?php
			if( in_array('administrator', $current_user->roles) || in_array('editor', $current_user->roles) ) {
				?>
				<li>
					<a class="dropdown-item dropdown-primary" href="<?php echo home_url( 'wp-admin' ); ?>">
						<i class="bi bi-window-sidebar me-2"></i>
						Escritorio
					</a>
				</li>
				<?php
			}
			?>
			<li>
				<a class="dropdown-item dropdown-danger" href="<?php echo wp_logout_url( home_url() ); ?>">
					<i class="bi bi-box-arrow-right me-2"></i>
					Cerrar sesión
				</a>
			</li>
		</ul>
	</div>
	<?php
} else {
	?>
	<a class="btn btn-secondary rounded-1" href="<?php echo wp_login_url(); ?>">
		<i class="bi bi-box-arrow-in-right me-1"></i>
		Ingresar
	</a>
	<?php
}
