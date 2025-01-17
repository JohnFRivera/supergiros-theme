<div class="position-absolute end-0">
    <?php
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $user_avatar_url = get_avatar_url( $current_user->user_email );
        $user_name = $current_user->first_name .' '. $current_user->last_name;
        $user_role = $current_user->roles[0];
        ?>
        <div class="dropdown">
            <button class="hstack gap-2 bg-transparent border-0 text-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="rounded-circle" src="<?php echo $user_avatar_url ?>" alt="" width="34px" height="34px">
                <div class="vstack">
                    <h6 class="text-start fw-semibold mb-0"><?php echo $user_name; ?></h6>
                    <small class="text-start lh-1 opacity-50"><?php echo ucfirst( $user_role ); ?></small>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end bg-light rounded-0 border-0 shadow mt-2 py-0">
                <li>
                    <a class="dropdown-item dropdown-primary" href="<?php echo home_url( 'wp-admin' ); ?>">
                        <i class="bi bi-window-sidebar me-2"></i>
                        Escritorio
                    </a>
                </li>
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
        <a class="btn btn-secondary rounded-1" href="<?php echo wp_login_url() ?>">
            <i class="bi bi-box-arrow-in-right me-1"></i>
            Ingresar
        </a>
        <?php
    }
    ?>
</div>