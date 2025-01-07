<?php
/* Template Name: Inicio de sesion personalizada */

if ( is_user_logged_in() ) {
    wp_redirect( home_url() );
    exit;
}
$error_message = '';
if ( isset( $_POST['wp-submit'] ) ) {
    $creds = array(
        'user_login'    => $_POST['log'],
        'user_password' => $_POST['pwd'],
        'remember'      => isset( $_POST['rememberme'] ) ? true : false,
    );
    // Intentar iniciar sesión con las credenciales
    $user = wp_signon( $creds, false );
    if ( is_wp_error( $user ) ) {
        $error_message = $user->get_error_message();
    } else {
        wp_redirect( home_url() ); // Redirigir al usuario después de un login exitoso
        exit;
    }
}

get_header();
$logo_ssvsa = get_template_directory_uri() . '/assets/images/logo-ssvsa.png';
?>

<main class="container-fluid bg-body-secondary py-5">
    <div class="row">
        <div class="col align-content-center">
            <div class="w-25 shadow bg-body rounded-1 my-5 mx-auto p-5">
                <div class="d-flex justify-content-center mb-5">
                    <img class="w-75" src="<?php echo esc_url( $logo_ssvsa ) ?>" alt="Logo de Super Servicios del Valle S.A." />
                </div>
                <form method="POST">
                    <?php
                    if ( $error_message ) {
                        ?>
                        <p class="text-danger lh-sm mb-3">
                            <?php echo $error_message ?>
                        </p>
                        <?php
                    }
                    ?>
                    <div class="shadow-sm rounded-1 mb-3">
                        <input class="form-control bg-white rounded-1 shadow-none" placeholder="Correo electrónico" type="text" name="log" id="user_login" autocapitalize="off" autocomplete="username" required>
                    </div>
                    <div class="position-relative shadow-sm rounded-1 mb-1">
                        <input class="form-control bg-white rounded-1 shadow-none" placeholder="Contraseña" type="password" name="pwd" id="user_pass" autocomplete="current-password" spellcheck="false" required>
                        <button class="position-absolute top-50 end-0 translate-middle-y btn rounded-circle border-0 fs-5 me-3 py-0 px-1" type="button" id="show_pass">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <label class="text-black-50 ms-1 mb-3" for="rememberme">
                        <input type="checkbox" name="rememberme" id="rememberme" value="forever"> Recordarme
                    </label>
                    <input class="w-100 btn btn-primary rounded-1 fw-medium" type="submit" name="wp-submit" id="wp-submit" value="Ingresar">
                </form>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
?>