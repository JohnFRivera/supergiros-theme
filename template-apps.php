<?php
/* Template Name: Aplicativos y Utilidades */
// Validar que el usuario este logueado
if( !is_user_logged_in() ) {
    wp_redirect( home_url() );
    exit;
}

get_header();
// Obtenemos nombre de usuario para hacer llamado a sus aplicaciones
$loggedUserName = 'john.rivera'; //wp_get_current_user()->user_login;
include( 'procedures/applications.php' );
$rows = pg_num_rows( $result );
?>
<main class="container-fluid bg-body-tertiary pt-4 pb-5">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="shadow banner-supergiros rounded-1 align-content-center mb-5 p-5">
                            <h2 class="position-relative z-2 text-white text-center text-uppercase fw-semibold mb-0"><?php echo get_the_title() ?></h2>
                        </div>
                    </div>
                </div>
                <div style="min-height: 382.38px;">
                    <div class="grid-container">
                        <?php
                        // Validar que el usuario tiene cargo asignado
                        if ( $rows <= 0 ) {
                            ?>
                            <div class="w-100 align-content-center">
                                <div class="w-50 shadow-sm bg-body rounded-1 mx-auto p-3 alert alert-dismissible fade show" role="alert">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="text-danger mb-3">
                                            <i class="bi bi-x-circle-fill me-1"></i>
                                            Error de asignación
                                        </h5>
                                        <button type="button" class="btn-close small shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <p class="mb-0">Su usuario no tiene aplicaciones asignadas, por favor contacte al administrador.</p>
                                </div>
                            </div>
                            <?php
                        } else {
                            while( $data = pg_fetch_array( $result ) ) {
                                $app_image = get_template_directory_uri()."/assets/images/apps/".str_replace(' ','',strtolower($data['name'])).".jpg";
                                ?>
                                <div class="post-translate shadow-sm bg-body rounded-1 p-3">
                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="ratio ratio-1x1 mx-auto mb-3">
                                            <img class="object-fit-cover rounded-4" src="<?php echo $app_image; ?>" alt="<?php echo $data['name']; ?>" />
                                        </div>
                                        <h6 class="text-center mb-0"><?php echo ucwords(strtolower($data['name'])); ?></h6>
                                        <a href="<?php echo $data['url']; ?>" class="stretched-link" target="_Blank"></a>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
